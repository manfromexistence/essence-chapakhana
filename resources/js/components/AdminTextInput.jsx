import React, { useState, useEffect } from 'react';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { cn } from '@/lib/utils';

/**
 * AdminTextInput Component
 * 
 * A reusable text input component for admin forms with validation and character limits
 * 
 * @param {string} label - The label for the input field
 * @param {string} id - The ID for the input field
 * @param {string} value - The current value of the input
 * @param {function} onChange - Callback function when value changes
 * @param {string} defaultValue - Default/seeded value to show initially
 * @param {number} minLength - Minimum character length (optional)
 * @param {number} maxLength - Maximum character length (optional)
 * @param {boolean} required - Whether the field is required
 * @param {string} error - Error message to display
 * @param {string} placeholder - Placeholder text
 * @param {string} type - Input type (text, email, url, etc.)
 * @param {string} helperText - Helper text to display below input
 * @param {boolean} showCharCount - Whether to show character count
 * @param {string} className - Additional CSS classes
 * @param {object} validation - Additional validation rules
 */
export const AdminTextInput = ({
    label,
    id,
    value,
    onChange,
    defaultValue = '',
    minLength,
    maxLength,
    required = false,
    error,
    placeholder = '',
    type = 'text',
    helperText,
    showCharCount = true,
    className,
    validation = {},
    disabled = false,
    ...props
}) => {
    const [internalValue, setInternalValue] = useState(value || defaultValue);
    const [validationError, setValidationError] = useState('');
    const [touched, setTouched] = useState(false);

    useEffect(() => {
        setInternalValue(value || defaultValue);
    }, [value, defaultValue]);

    const handleChange = (e) => {
        const newValue = e.target.value;

        // Check max length
        if (maxLength && newValue.length > maxLength) {
            return; // Don't allow input beyond max length
        }

        setInternalValue(newValue);
        setTouched(true);

        // Validate on change
        const validationResult = validateInput(newValue);
        setValidationError(validationResult);

        // Call parent onChange
        if (onChange) {
            onChange(e);
        }
    };

    const handleBlur = () => {
        setTouched(true);
        const validationResult = validateInput(internalValue);
        setValidationError(validationResult);
    };

    const validateInput = (val) => {
        // Required validation
        if (required && !val?.trim()) {
            return `${label || 'This field'} is required`;
        }

        // Min length validation
        if (minLength && val.length > 0 && val.length < minLength) {
            return `Minimum ${minLength} characters required`;
        }

        // Max length validation (shouldn't happen due to input prevention, but for completeness)
        if (maxLength && val.length > maxLength) {
            return `Maximum ${maxLength} characters allowed`;
        }

        // Email validation
        if (type === 'email' && val) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(val)) {
                return 'Please enter a valid email address';
            }
        }

        // URL validation
        if (type === 'url' && val) {
            try {
                new URL(val);
            } catch {
                return 'Please enter a valid URL';
            }
        }

        // Custom validation
        if (validation.pattern && val) {
            const regex = new RegExp(validation.pattern);
            if (!regex.test(val)) {
                return validation.patternMessage || 'Invalid format';
            }
        }

        if (validation.custom && typeof validation.custom === 'function') {
            const customError = validation.custom(val);
            if (customError) return customError;
        }

        return '';
    };

    const characterCount = internalValue?.length || 0;
    const displayError = error || (touched && validationError);
    const isValid = !displayError && touched && internalValue;
    const showMaxLengthWarning = maxLength && characterCount >= maxLength * 0.9;

    return (
        <div className={cn('space-y-2', className)}>
            {label && (
                <Label htmlFor={id} className="flex items-center gap-1">
                    {label}
                    {required && <span className="text-red-500">*</span>}
                    {/* {defaultValue && (
                        <span className="text-xs text-muted-foreground ml-1">
                            (seeded)
                        </span>
                    )} */}
                </Label>
            )}

            <div className="relative">
                <Input
                    id={id}
                    type={type}
                    value={internalValue}
                    onChange={handleChange}
                    onBlur={handleBlur}
                    placeholder={placeholder}
                    required={required}
                    disabled={disabled}
                    className={cn(
                        displayError && 'border-red-500 focus-visible:ring-red-500',
                        isValid && 'border-green-500 focus-visible:ring-green-500',
                        showMaxLengthWarning && 'border-amber-500'
                    )}
                    {...props}
                />
                
                {isValid && (
                    <div className="absolute right-3 top-1/2 -translate-y-1/2">
                        <svg
                            className="h-4 w-4 text-green-500"
                            fill="none"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                )}
            </div>

            <div className="flex items-start justify-between gap-2">
                <div className="flex-1">
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

                {showCharCount && (minLength || maxLength) && (
                    <div className="flex-shrink-0">
                        <p
                            className={cn(
                                'text-xs',
                                showMaxLengthWarning
                                    ? 'text-amber-600 font-medium'
                                    : 'text-muted-foreground'
                            )}
                        >
                            {characterCount}
                            {maxLength && `/${maxLength}`}
                            {!maxLength && minLength && characterCount < minLength && (
                                <span className="text-muted-foreground">
                                    {' '}
                                    (min: {minLength})
                                </span>
                            )}
                        </p>
                    </div>
                )}
            </div>
        </div>
    );
};

export default AdminTextInput;
