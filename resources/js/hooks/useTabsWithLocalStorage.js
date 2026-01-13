import { useState, useEffect } from 'react';

/**
 * Custom hook to persist tab state in localStorage
 * @param {string} storageKey - Unique key for localStorage
 * @param {string} defaultValue - Default tab value
 * @returns {[string, function]} - Current tab value and setter function
 */
export function useTabsWithLocalStorage(storageKey, defaultValue) {
    // Initialize state from localStorage or use default
    const [activeTab, setActiveTab] = useState(() => {
        try {
            const storedValue = localStorage.getItem(storageKey);
            return storedValue || defaultValue;
        } catch (error) {
            console.warn(`Failed to read from localStorage for key "${storageKey}":`, error);
            return defaultValue;
        }
    });

    // Update localStorage whenever activeTab changes
    useEffect(() => {
        try {
            localStorage.setItem(storageKey, activeTab);
        } catch (error) {
            console.warn(`Failed to write to localStorage for key "${storageKey}":`, error);
        }
    }, [activeTab, storageKey]);

    return [activeTab, setActiveTab];
}
