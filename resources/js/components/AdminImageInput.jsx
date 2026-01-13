import React, { useState, useEffect, useRef } from 'react';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils';
import { Upload, X, Image as ImageIcon, LinkIcon, Loader2 } from 'lucide-react';
import axios from 'axios';

/**
 * AdminImageInput Component
 * 
 * A reusable image input component for admin forms with support for file upload, URL input,
 * preview, and default/seeded images.
 * 
 * When a file is uploaded, it is immediately sent to the server and the returned URL is used.
 * This ensures the form always contains URL strings, not File objects.
 * 
 * @param {string} label - The label for the input field
 * @param {string} id - The ID for the input field
 * @param {string} value - The current value (URL string)
 * @param {function} onChange - Callback function when value changes (receives URL string)
 * @param {string} defaultImage - Default/seeded image URL to show initially
 * @param {string} uploadFolder - Folder name for uploads (default: 'images')
 * @param {boolean} required - Whether the field is required
 * @param {string} error - Error message to display
 * @param {string} helperText - Helper text to display below input
 * @param {string} className - Additional CSS classes
 * @param {number} maxSizeMB - Maximum file size in MB (default: 15)
 * @param {array} acceptedFormats - Array of accepted file formats (default: ['jpg', 'jpeg', 'png', 'webp', 'gif'])
 * @param {string} aspectRatio - CSS aspect ratio for preview (e.g., '16/9', '1/1')
 * @param {boolean} showPreview - Whether to show image preview (default: true)
 */
export const AdminImageInput = ({
    label,
    id,
    value,
    onChange,
    defaultImage = '',
    uploadFolder = 'images',
    required = false,
    error,
    helperText,
    className,
    maxSizeMB = 15,
    acceptedFormats = ['jpg', 'jpeg', 'png', 'webp', 'gif'],
    aspectRatio = '16/9',
    showPreview = true,
    disabled = false,
    currentImage, // Destructure to prevent passing to DOM
    ...props
}) => {
    // Ensure we only work with string values
    const getStringValue = (val) => (typeof val === 'string' ? val : '');
    
    const [previewUrl, setPreviewUrl] = useState(getStringValue(value) || getStringValue(defaultImage));
    const [imageSource, setImageSource] = useState(getStringValue(value) ? 'url' : (getStringValue(defaultImage) ? 'default' : null));
    const [urlInput, setUrlInput] = useState(getStringValue(value) || getStringValue(defaultImage) || '');
    const [validationError, setValidationError] = useState('');
    const [isDragging, setIsDragging] = useState(false);
    const [isUploading, setIsUploading] = useState(false);
    const fileInputRef = useRef(null);

    useEffect(() => {
        // Update preview when value changes externally
        const strValue = getStringValue(value);
        const strDefault = getStringValue(defaultImage);
        
        if (strValue) {
            setPreviewUrl(strValue);
            setImageSource('url');
            setUrlInput(strValue);
        } else if (strDefault) {
            setPreviewUrl(strDefault);
            setImageSource('default');
            setUrlInput(strDefault);
        } else {
            setPreviewUrl('');
            setImageSource(null);
            setUrlInput('');
        }
    }, [value, defaultImage]);

    const validateFile = (file) => {
        // Check file type
        const fileExtension = file.name.split('.').pop().toLowerCase();
        if (!acceptedFormats.includes(fileExtension)) {
            return `File type not accepted. Allowed: ${acceptedFormats.join(', ')}`;
        }

        // Check file size
        const fileSizeMB = file.size / (1024 * 1024);
        if (fileSizeMB > maxSizeMB) {
            return `File size must be less than ${maxSizeMB}MB`;
        }

        // Check if it's actually an image
        if (!file.type.startsWith('image/')) {
            return 'File must be an image';
        }

        return '';
    };

    const uploadFile = async (file) => {
        setIsUploading(true);
        setValidationError('');

        try {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('folder', uploadFolder);

            // Get CSRF token - try multiple sources
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
            };
            
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }

            const response = await axios.post('/admin/upload-image', formData, { headers });

            if (response.data.success && response.data.url) {
                const url = response.data.url;
                setPreviewUrl(url);
                setImageSource('url');
                setUrlInput(url);
                if (onChange) {
                    onChange(url);
                }
            } else {
                setValidationError('Upload failed. Please try again.');
            }
        } catch (err) {
            console.error('Upload error:', err);
            const message = err.response?.data?.message 
                || err.response?.data?.errors?.image?.[0]
                || 'Upload failed. Please try again.';
            setValidationError(message);
        } finally {
            setIsUploading(false);
        }
    };

    const handleFileChange = async (e) => {
        const file = e.target.files?.[0];
        if (!file) return;

        const validationResult = validateFile(file);
        if (validationResult) {
            setValidationError(validationResult);
            return;
        }

        // Show local preview immediately
        const localPreview = URL.createObjectURL(file);
        setPreviewUrl(localPreview);
        setImageSource('file');

        // Upload the file
        await uploadFile(file);

        // Clean up local preview
        URL.revokeObjectURL(localPreview);
    };

    const handleUrlChange = (e) => {
        setUrlInput(e.target.value);
    };

    const handleUrlSubmit = () => {
        const url = typeof urlInput === 'string' ? urlInput.trim() : '';
        if (!url) {
            setValidationError('Please enter a URL');
            return;
        }

        // Basic URL validation
        try {
            new URL(url);
            setValidationError('');
            setPreviewUrl(url);
            setImageSource('url');
            if (onChange) {
                onChange(url);
            }
        } catch {
            setValidationError('Please enter a valid URL');
        }
    };

    const handleDragOver = (e) => {
        e.preventDefault();
        setIsDragging(true);
    };

    const handleDragLeave = (e) => {
        e.preventDefault();
        setIsDragging(false);
    };

    const handleDrop = async (e) => {
        e.preventDefault();
        setIsDragging(false);

        const file = e.dataTransfer.files?.[0];
        if (!file) return;

        const validationResult = validateFile(file);
        if (validationResult) {
            setValidationError(validationResult);
            return;
        }

        // Show local preview immediately
        const localPreview = URL.createObjectURL(file);
        setPreviewUrl(localPreview);
        setImageSource('file');

        // Upload the file
        await uploadFile(file);

        // Clean up local preview
        URL.revokeObjectURL(localPreview);
    };

    const handleRemove = () => {
        setPreviewUrl(defaultImage || '');
        setImageSource(defaultImage ? 'default' : null);
        setUrlInput(defaultImage || '');
        setValidationError('');
        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
        if (onChange) {
            onChange(defaultImage || '');
        }
    };

    const handleBrowseClick = () => {
        if (!isUploading) {
            fileInputRef.current?.click();
        }
    };

    const displayError = error || validationError;
    const hasImage = previewUrl && previewUrl !== '';

    return (
        <div className={cn('space-y-3', className)}>
            {label && (
                <Label htmlFor={id} className="flex items-center gap-1">
                    {label}
                    {required && <span className="text-red-500">*</span>}
                    {imageSource === 'default' && (
                        <span className="text-xs text-muted-foreground ml-1">
                            (seeded image)
                        </span>
                    )}
                </Label>
            )}

            {/* Hidden file input */}
            <input
                ref={fileInputRef}
                id={id}
                type="file"
                accept={acceptedFormats.map((f) => `.${f}`).join(',')}
                onChange={handleFileChange}
                className="hidden"
                disabled={disabled || isUploading}
                {...props}
            />

            {/* Image Preview with hover overlay */}
            {showPreview && hasImage && (
                <div className="relative group">
                    <div
                        className={cn(
                            'relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 cursor-pointer transition-all',
                            isDragging && 'border-primary bg-primary/5',
                            isUploading && 'opacity-70 cursor-wait'
                        )}
                        style={{ aspectRatio }}
                        onDragOver={handleDragOver}
                        onDragLeave={handleDragLeave}
                        onDrop={handleDrop}
                        onClick={handleBrowseClick}
                    >
                        <img
                            src={previewUrl}
                            alt="Preview"
                            className="h-full w-full object-contain"
                            onError={(e) => {
                                e.target.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="200"%3E%3Crect fill="%23ddd" width="200" height="200"/%3E%3Ctext x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" fill="%23999" font-family="sans-serif" font-size="14"%3EImage not found%3C/text%3E%3C/svg%3E';
                            }}
                        />
                        
                        {/* Upload progress overlay */}
                        {isUploading && (
                            <div className="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-2">
                                <Loader2 className="h-8 w-8 text-white animate-spin" />
                                <span className="text-white text-sm font-medium">Uploading...</span>
                            </div>
                        )}
                        
                        {/* Hover overlay with replace button */}
                        {!isUploading && (
                            <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2">
                                <Upload className="h-8 w-8 text-white" />
                                <span className="text-white text-sm font-medium">Click to replace</span>
                                <span className="text-white/70 text-xs">or drag & drop</span>
                            </div>
                        )}

                        {/* Default badge */}
                        {imageSource === 'default' && !isUploading && (
                            <div className="absolute top-2 left-2 z-10">
                                <span className="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-800">
                                    Default
                                </span>
                            </div>
                        )}
                    </div>

                    {/* Remove button */}
                    {!isUploading && (
                        <Button
                            type="button"
                            variant="destructive"
                            size="icon"
                            className="absolute top-2 right-2 h-8 w-8 opacity-0 group-hover:opacity-100 transition-opacity z-10"
                            onClick={(e) => {
                                e.stopPropagation();
                                handleRemove();
                            }}
                            disabled={disabled}
                        >
                            <X className="h-4 w-4" />
                        </Button>
                    )}
                </div>
            )}

            {/* Upload Area when no image */}
            {!hasImage && (
                <div
                    className={cn(
                        'relative flex flex-col items-center justify-center rounded-lg border-2 border-dashed p-6 transition-colors cursor-pointer',
                        isDragging
                            ? 'border-primary bg-primary/5'
                            : 'border-gray-300 hover:border-gray-400',
                        (disabled || isUploading) && 'opacity-50 cursor-not-allowed'
                    )}
                    onDragOver={handleDragOver}
                    onDragLeave={handleDragLeave}
                    onDrop={handleDrop}
                    onClick={handleBrowseClick}
                >
                    {isUploading ? (
                        <>
                            <Loader2 className="h-10 w-10 text-gray-400 mb-3 animate-spin" />
                            <p className="text-sm font-medium text-gray-700 mb-1">
                                Uploading...
                            </p>
                        </>
                    ) : (
                        <>
                            <ImageIcon className="h-10 w-10 text-gray-400 mb-3" />
                            <p className="text-sm font-medium text-gray-700 mb-1">
                                Click to upload or drag and drop
                            </p>
                            <p className="text-xs text-gray-500">
                                {acceptedFormats.map((f) => f.toUpperCase()).join(', ')} up to {maxSizeMB}MB
                            </p>
                        </>
                    )}
                </div>
            )}

            {/* URL Input - Always visible */}
            <div className="flex gap-2">
                <div className="relative flex-1">
                    <LinkIcon className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" />
                    <Input
                        type="url"
                        placeholder="Or enter image URL..."
                        value={urlInput}
                        onChange={handleUrlChange}
                        disabled={disabled || isUploading}
                        className="pl-9"
                        onKeyDown={(e) => {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                handleUrlSubmit();
                            }
                        }}
                    />
                </div>
                <Button
                    type="button"
                    variant="secondary"
                    onClick={handleUrlSubmit}
                    disabled={disabled || isUploading || !urlInput || (typeof urlInput === 'string' && !urlInput.trim())}
                >
                    Load
                </Button>
            </div>

            {/* Error and Helper Text */}
            {displayError && (
                <p className="text-sm text-red-600 flex items-center gap-1">
                    <svg
                        className="h-3 w-3"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fillRule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clipRule="evenodd"
                        />
                    </svg>
                    {displayError}
                </p>
            )}

            {helperText && !displayError && (
                <p className="text-sm text-muted-foreground">{helperText}</p>
            )}
        </div>
    );
};

export default AdminImageInput;
