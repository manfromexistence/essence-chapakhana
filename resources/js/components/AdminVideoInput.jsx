import React, { useState, useEffect, useRef } from 'react';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils';
import { Upload, X, Video as VideoIcon, Link as LinkIcon, Play, Pause } from 'lucide-react';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';

/**
 * AdminVideoInput Component
 * 
 * A reusable video input component for admin forms with support for file upload, URL input,
 * preview, and default/seeded videos
 * 
 * @param {string} label - The label for the input field
 * @param {string} id - The ID for the input field
 * @param {string|File} value - The current value (URL or File object)
 * @param {function} onChange - Callback function when value changes
 * @param {string} defaultVideo - Default/seeded video URL to show initially
 * @param {string} posterImage - Poster image URL to show before video plays
 * @param {function} onPosterChange - Callback function when poster changes
 * @param {boolean} required - Whether the field is required
 * @param {string} error - Error message to display
 * @param {string} helperText - Helper text to display below input
 * @param {string} className - Additional CSS classes
 * @param {number} maxSizeMB - Maximum file size in MB (default: 100)
 * @param {array} acceptedFormats - Array of accepted file formats (default: ['mp4', 'webm', 'ogg', 'mov'])
 * @param {string} aspectRatio - CSS aspect ratio for preview (e.g., '16/9', '1/1')
 * @param {boolean} showPreview - Whether to show video preview (default: true)
 * @param {boolean} showPosterInput - Whether to show poster image input (default: true)
 */
export const AdminVideoInput = ({
    label,
    id,
    value,
    onChange,
    defaultVideo = '',
    posterImage = '',
    onPosterChange,
    required = false,
    error,
    helperText,
    className,
    maxSizeMB = 100,
    acceptedFormats = ['mp4', 'webm', 'ogg', 'mov'],
    aspectRatio = '16/9',
    showPreview = true,
    showPosterInput = true,
    disabled = false,
    ...props
}) => {
    const [previewUrl, setPreviewUrl] = useState(defaultVideo);
    const [videoSource, setVideoSource] = useState(defaultVideo ? 'default' : null); // 'default', 'file', 'url'
    const [urlInput, setUrlInput] = useState('');
    const [posterUrl, setPosterUrl] = useState(posterImage);
    const [validationError, setValidationError] = useState('');
    const [isDragging, setIsDragging] = useState(false);
    const [isPlaying, setIsPlaying] = useState(false);
    const fileInputRef = useRef(null);
    const videoRef = useRef(null);

    useEffect(() => {
        // Update preview when value changes
        if (value instanceof File) {
            const objectUrl = URL.createObjectURL(value);
            setPreviewUrl(objectUrl);
            setVideoSource('file');
            return () => URL.revokeObjectURL(objectUrl);
        } else if (typeof value === 'string' && value) {
            setPreviewUrl(value);
            setVideoSource('url');
        } else if (defaultVideo && !value) {
            setPreviewUrl(defaultVideo);
            setVideoSource('default');
        }
    }, [value, defaultVideo]);

    useEffect(() => {
        setPosterUrl(posterImage);
    }, [posterImage]);

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

        // Check if it's actually a video
        if (!file.type.startsWith('video/')) {
            return 'File must be a video';
        }

        return '';
    };

    const handleFileChange = (e) => {
        const file = e.target.files?.[0];
        if (!file) return;

        const validationResult = validateFile(file);
        if (validationResult) {
            setValidationError(validationResult);
            return;
        }

        setValidationError('');
        if (onChange) {
            onChange(file);
        }
    };

    const handleUrlChange = (e) => {
        setUrlInput(e.target.value);
    };

    const handleUrlSubmit = () => {
        if (!urlInput.trim()) {
            setValidationError('Please enter a URL');
            return;
        }

        // Basic URL validation - allow relative URLs starting with /
        if (urlInput.startsWith('/') || urlInput.startsWith('http')) {
            setValidationError('');
            if (onChange) {
                onChange(urlInput);
            }
        } else {
            try {
                new URL(urlInput);
                setValidationError('');
                if (onChange) {
                    onChange(urlInput);
                }
            } catch {
                setValidationError('Please enter a valid URL');
            }
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

    const handleDrop = (e) => {
        e.preventDefault();
        setIsDragging(false);

        const file = e.dataTransfer.files?.[0];
        if (!file) return;

        const validationResult = validateFile(file);
        if (validationResult) {
            setValidationError(validationResult);
            return;
        }

        setValidationError('');
        if (onChange) {
            onChange(file);
        }
    };

    const handleRemove = () => {
        setPreviewUrl(defaultVideo || '');
        setVideoSource(defaultVideo ? 'default' : null);
        setUrlInput('');
        setValidationError('');
        setIsPlaying(false);
        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
        if (onChange) {
            onChange(null);
        }
    };

    const handleBrowseClick = () => {
        fileInputRef.current?.click();
    };

    const handlePlayPause = () => {
        if (videoRef.current) {
            if (isPlaying) {
                videoRef.current.pause();
            } else {
                videoRef.current.play();
            }
            setIsPlaying(!isPlaying);
        }
    };

    const handlePosterUrlChange = (e) => {
        const newPosterUrl = e.target.value;
        setPosterUrl(newPosterUrl);
        if (onPosterChange) {
            onPosterChange(newPosterUrl);
        }
    };

    const displayError = error || validationError;
    const hasVideo = previewUrl && previewUrl !== '';

    return (
        <div className={cn('space-y-3', className)}>
            {label && (
                <Label htmlFor={id} className="flex items-center gap-1">
                    {label}
                    {required && <span className="text-red-500">*</span>}
                    {videoSource === 'default' && (
                        <span className="text-xs text-muted-foreground ml-1">
                            (seeded video)
                        </span>
                    )}
                </Label>
            )}

            {/* Video Preview */}
            {showPreview && hasVideo && (
                <div className="relative group">
                    <div
                        className="relative overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-gray-900"
                        style={{ aspectRatio }}
                    >
                        <video
                            ref={videoRef}
                            src={previewUrl}
                            poster={posterUrl}
                            className="h-full w-full object-contain"
                            onEnded={() => setIsPlaying(false)}
                            onError={(e) => {
                                console.error('Video load error:', e);
                            }}
                        />
                        {/* Play/Pause Overlay */}
                        <div 
                            className="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                            onClick={handlePlayPause}
                        >
                            <div className="h-16 w-16 rounded-full bg-white/90 flex items-center justify-center shadow-lg">
                                {isPlaying ? (
                                    <Pause className="h-8 w-8 text-gray-900" />
                                ) : (
                                    <Play className="h-8 w-8 text-gray-900 ml-1" />
                                )}
                            </div>
                        </div>
                        {videoSource === 'default' && (
                            <div className="absolute top-2 left-2">
                                <span className="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-800">
                                    Default
                                </span>
                            </div>
                        )}
                    </div>
                    <Button
                        type="button"
                        variant="destructive"
                        size="icon"
                        className="absolute top-2 right-2 h-8 w-8 opacity-0 group-hover:opacity-100 transition-opacity"
                        onClick={handleRemove}
                        disabled={disabled}
                    >
                        <X className="h-4 w-4" />
                    </Button>
                </div>
            )}

            {/* Video URL Display */}
            {hasVideo && (
                <div className="flex items-center gap-2 p-2 bg-muted rounded-md">
                    <LinkIcon className="h-4 w-4 text-muted-foreground flex-shrink-0" />
                    <code className="text-xs text-muted-foreground truncate flex-1">
                        {previewUrl}
                    </code>
                </div>
            )}

            {/* Upload Options */}
            {!hasVideo && (
                <Tabs defaultValue="upload" className="w-full">
                    <TabsList className="grid w-full grid-cols-2">
                        <TabsTrigger value="upload" className="flex items-center gap-2">
                            <Upload className="h-4 w-4" />
                            Upload File
                        </TabsTrigger>
                        <TabsTrigger value="url" className="flex items-center gap-2">
                            <LinkIcon className="h-4 w-4" />
                            URL
                        </TabsTrigger>
                    </TabsList>

                    <TabsContent value="upload" className="mt-3">
                        {/* Drag and Drop Area */}
                        <div
                            className={cn(
                                'relative flex flex-col items-center justify-center rounded-lg border-2 border-dashed p-6 transition-colors',
                                isDragging
                                    ? 'border-primary bg-primary/5'
                                    : 'border-gray-300 hover:border-gray-400',
                                disabled && 'opacity-50 cursor-not-allowed'
                            )}
                            onDragOver={handleDragOver}
                            onDragLeave={handleDragLeave}
                            onDrop={handleDrop}
                        >
                            <input
                                ref={fileInputRef}
                                id={id}
                                type="file"
                                accept={acceptedFormats.map((f) => `.${f}`).join(',')}
                                onChange={handleFileChange}
                                className="hidden"
                                required={required && !defaultVideo}
                                disabled={disabled}
                                {...props}
                            />

                            <VideoIcon className="h-10 w-10 text-gray-400 mb-3" />
                            <p className="text-sm font-medium text-gray-700 mb-1">
                                Drag and drop or click to upload
                            </p>
                            <p className="text-xs text-gray-500 mb-3">
                                {acceptedFormats.map((f) => f.toUpperCase()).join(', ')} up to {maxSizeMB}MB
                            </p>
                            <Button
                                type="button"
                                variant="outline"
                                size="sm"
                                onClick={handleBrowseClick}
                                disabled={disabled}
                            >
                                Browse Files
                            </Button>
                        </div>
                    </TabsContent>

                    <TabsContent value="url" className="mt-3">
                        <div className="flex gap-2">
                            <Input
                                type="url"
                                placeholder="/videos/example.mp4 or https://..."
                                value={urlInput}
                                onChange={handleUrlChange}
                                disabled={disabled}
                                onKeyDown={(e) => {
                                    if (e.key === 'Enter') {
                                        e.preventDefault();
                                        handleUrlSubmit();
                                    }
                                }}
                            />
                            <Button
                                type="button"
                                onClick={handleUrlSubmit}
                                disabled={disabled}
                            >
                                Load
                            </Button>
                        </div>
                    </TabsContent>
                </Tabs>
            )}

            {/* Poster Image Input */}
            {showPosterInput && hasVideo && (
                <div className="space-y-2">
                    <Label htmlFor={`${id}-poster`} className="text-sm">
                        Video Poster Image
                    </Label>
                    <Input
                        id={`${id}-poster`}
                        type="url"
                        placeholder="https://example.com/poster.jpg"
                        value={posterUrl}
                        onChange={handlePosterUrlChange}
                        disabled={disabled}
                    />
                    <p className="text-xs text-muted-foreground">
                        Image shown before video plays
                    </p>
                </div>
            )}

            {/* Change Video Button when preview exists */}
            {hasVideo && (
                <div className="flex gap-2">
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        onClick={handleBrowseClick}
                        disabled={disabled}
                        className="flex-1"
                    >
                        <Upload className="h-4 w-4 mr-2" />
                        Change Video
                    </Button>
                    <input
                        ref={fileInputRef}
                        id={`${id}-change`}
                        type="file"
                        accept={acceptedFormats.map((f) => `.${f}`).join(',')}
                        onChange={handleFileChange}
                        className="hidden"
                        disabled={disabled}
                    />
                </div>
            )}

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

export default AdminVideoInput;
