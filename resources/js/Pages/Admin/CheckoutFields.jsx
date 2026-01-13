import AdminLayout from '@/Layouts/AdminLayout';
import { useState } from 'react';
import { router, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { AdminTextInput } from '@/components/AdminTextInput';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Plus, Pencil, Trash2, GripVertical, Eye, EyeOff, CheckCircle, XCircle } from 'lucide-react';

export default function CheckoutFields({ fields = [] }) {
    const [isCreateOpen, setIsCreateOpen] = useState(false);
    const [isEditOpen, setIsEditOpen] = useState(false);
    const [isDeleteOpen, setIsDeleteOpen] = useState(false);
    const [selectedField, setSelectedField] = useState(null);

    const createForm = useForm({
        section: 'billing',
        field_key: '',
        label: '',
        placeholder: '',
        type: 'text',
        is_required: true,
        is_visible: true,
        sort_order: 0,
        options: '',
    });

    const editForm = useForm({
        section: 'billing',
        field_key: '',
        label: '',
        placeholder: '',
        type: 'text',
        is_required: true,
        is_visible: true,
        sort_order: 0,
        options: '',
    });

    const fieldTypes = [
        { value: 'text', label: 'Text' },
        { value: 'email', label: 'Email' },
        { value: 'tel', label: 'Phone' },
        { value: 'textarea', label: 'Textarea' },
        { value: 'select', label: 'Select Dropdown' },
        { value: 'checkbox', label: 'Checkbox' },
        { value: 'radio', label: 'Radio Buttons' },
    ];

    const sections = [
        { value: 'billing', label: 'Billing Information' },
        { value: 'shipping', label: 'Shipping Information' },
        { value: 'additional', label: 'Additional Information' },
    ];

    const handleCreate = (e) => {
        e.preventDefault();
        const formData = { ...createForm.data };

        // Convert options string to array if present
        if (formData.options && typeof formData.options === 'string') {
            formData.options = formData.options.split(',').map(opt => opt.trim()).filter(opt => opt);
        } else {
            formData.options = [];
        }

        createForm.post('/admin/checkout-fields', {
            data: formData,
            onSuccess: () => {
                setIsCreateOpen(false);
                createForm.reset();
            },
        });
    };

    const handleEdit = (field) => {
        setSelectedField(field);
        editForm.setData({
            section: field.section || 'billing',
            field_key: field.field_key || '',
            label: field.label || '',
            placeholder: field.placeholder || '',
            type: field.type || 'text',
            is_required: field.is_required,
            is_visible: field.is_visible,
            sort_order: field.sort_order || 0,
            options: Array.isArray(field.options) ? field.options.join(', ') : '',
        });
        setIsEditOpen(true);
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        const formData = { ...editForm.data };

        // Convert options string to array if present
        if (formData.options && typeof formData.options === 'string') {
            formData.options = formData.options.split(',').map(opt => opt.trim()).filter(opt => opt);
        } else {
            formData.options = [];
        }

        editForm.put(`/admin/checkout-fields/${selectedField.id}`, {
            data: formData,
            onSuccess: () => {
                setIsEditOpen(false);
                editForm.reset();
            },
        });
    };

    const handleDelete = () => {
        router.delete(`/admin/checkout-fields/${selectedField.id}`, {
            onSuccess: () => setIsDeleteOpen(false),
        });
    };

    const handleToggleVisibility = (field) => {
        router.patch(`/admin/checkout-fields/${field.id}/toggle-visibility`, {
            is_visible: !field.is_visible,
        });
    };

    const handleToggleRequired = (field) => {
        router.patch(`/admin/checkout-fields/${field.id}/toggle-required`, {
            is_required: !field.is_required,
        });
    };

    // Group fields by section
    const groupedFields = fields.reduce((acc, field) => {
        const section = field.section || 'billing';
        if (!acc[section]) {
            acc[section] = [];
        }
        acc[section].push(field);
        return acc;
    }, {});

    const getSectionLabel = (section) => {
        const found = sections.find(s => s.value === section);
        return found ? found.label : section;
    };

    return (
        <>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Checkout Fields</h1>
                        <p className="text-muted-foreground">
                            Manage checkout form fields and their configurations
                        </p>
                    </div>
                    <Button onClick={() => setIsCreateOpen(true)}>
                        <Plus className="mr-2 h-4 w-4" />
                        Add Field
                    </Button>
                </div>

                {/* Fields grouped by section */}
                {Object.entries(groupedFields).map(([section, sectionFields]) => (
                    <Card key={section}>
                        <CardHeader>
                            <CardTitle>{getSectionLabel(section)}</CardTitle>
                            <CardDescription>
                                {sectionFields.length} field{sectionFields.length !== 1 ? 's' : ''} in this section
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead className="w-[50px]">Order</TableHead>
                                        <TableHead>Field Key</TableHead>
                                        <TableHead>Label</TableHead>
                                        <TableHead>Type</TableHead>
                                        <TableHead>Required</TableHead>
                                        <TableHead>Visible</TableHead>
                                        <TableHead className="text-right">Actions</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {sectionFields
                                        .sort((a, b) => a.sort_order - b.sort_order)
                                        .map((field) => (
                                            <TableRow key={field.id}>
                                                <TableCell>
                                                    <div className="flex items-center gap-2">
                                                        <GripVertical className="h-4 w-4 text-muted-foreground" />
                                                        <span className="text-sm text-muted-foreground">
                                                            {field.sort_order}
                                                        </span>
                                                    </div>
                                                </TableCell>
                                                <TableCell className="font-mono text-sm">
                                                    {field.field_key}
                                                </TableCell>
                                                <TableCell className="font-medium">
                                                    {field.label}
                                                </TableCell>
                                                <TableCell>
                                                    <Badge variant="outline">
                                                        {field.type}
                                                    </Badge>
                                                </TableCell>
                                                <TableCell>
                                                    <Button
                                                        variant="ghost"
                                                        size="sm"
                                                        onClick={() => handleToggleRequired(field)}
                                                        className="p-1"
                                                    >
                                                        {field.is_required ? (
                                                            <CheckCircle className="h-5 w-5 text-green-600" />
                                                        ) : (
                                                            <XCircle className="h-5 w-5 text-muted-foreground" />
                                                        )}
                                                    </Button>
                                                </TableCell>
                                                <TableCell>
                                                    <Button
                                                        variant="ghost"
                                                        size="sm"
                                                        onClick={() => handleToggleVisibility(field)}
                                                        className="p-1"
                                                    >
                                                        {field.is_visible ? (
                                                            <Eye className="h-5 w-5 text-green-600" />
                                                        ) : (
                                                            <EyeOff className="h-5 w-5 text-muted-foreground" />
                                                        )}
                                                    </Button>
                                                </TableCell>
                                                <TableCell className="text-right">
                                                    <div className="flex justify-end gap-2">
                                                        <Button
                                                            variant="outline"
                                                            size="sm"
                                                            onClick={() => handleEdit(field)}
                                                        >
                                                            <Pencil className="h-4 w-4" />
                                                        </Button>
                                                        <Button
                                                            variant="destructive"
                                                            size="sm"
                                                            onClick={() => {
                                                                setSelectedField(field);
                                                                setIsDeleteOpen(true);
                                                            }}
                                                        >
                                                            <Trash2 className="h-4 w-4" />
                                                        </Button>
                                                    </div>
                                                </TableCell>
                                            </TableRow>
                                        ))}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                ))}

                {/* Show empty state if no fields */}
                {Object.keys(groupedFields).length === 0 && (
                    <Card>
                        <CardContent className="py-12 text-center">
                            <p className="text-muted-foreground">
                                No checkout fields configured yet. Click "Add Field" to create one.
                            </p>
                        </CardContent>
                    </Card>
                )}
            </div>

            {/* Create Dialog */}
            <Dialog open={isCreateOpen} onOpenChange={setIsCreateOpen}>
                <DialogContent className="max-w-lg">
                    <DialogHeader>
                        <DialogTitle>Create Checkout Field</DialogTitle>
                        <DialogDescription>
                            Add a new field to the checkout form
                        </DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleCreate}>
                        <div className="space-y-4 py-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="section">Section *</Label>
                                    <Select
                                        value={createForm.data.section}
                                        onValueChange={(value) => createForm.setData('section', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select section" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {sections.map((section) => (
                                                <SelectItem key={section.value} value={section.value}>
                                                    {section.label}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="type">Field Type *</Label>
                                    <Select
                                        value={createForm.data.type}
                                        onValueChange={(value) => createForm.setData('type', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select type" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {fieldTypes.map((type) => (
                                                <SelectItem key={type.value} value={type.value}>
                                                    {type.label}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>

                            <AdminTextInput
                                label="Field Key"
                                id="field_key"
                                value={createForm.data.field_key}
                                onChange={(e) => createForm.setData('field_key', e.target.value.toLowerCase().replace(/\s+/g, '_'))}
                                required
                                error={createForm.errors.field_key}
                                placeholder="e.g., customer_name"
                                helperText="Unique identifier for this field (lowercase, no spaces)"
                            />

                            <AdminTextInput
                                label="Label"
                                id="label"
                                value={createForm.data.label}
                                onChange={(e) => createForm.setData('label', e.target.value)}
                                required
                                error={createForm.errors.label}
                                placeholder="e.g., Customer Name"
                            />

                            <AdminTextInput
                                label="Placeholder"
                                id="placeholder"
                                value={createForm.data.placeholder}
                                onChange={(e) => createForm.setData('placeholder', e.target.value)}
                                error={createForm.errors.placeholder}
                                placeholder="e.g., Enter your name"
                            />

                            <AdminTextInput
                                label="Sort Order"
                                id="sort_order"
                                type="number"
                                value={createForm.data.sort_order}
                                onChange={(e) => createForm.setData('sort_order', parseInt(e.target.value) || 0)}
                                error={createForm.errors.sort_order}
                                placeholder="0"
                                helperText="Lower numbers appear first"
                            />

                            {(createForm.data.type === 'select' || createForm.data.type === 'radio') && (
                                <AdminTextInput
                                    label="Options"
                                    id="options"
                                    value={createForm.data.options}
                                    onChange={(e) => createForm.setData('options', e.target.value)}
                                    error={createForm.errors.options}
                                    placeholder="Option 1, Option 2, Option 3"
                                    helperText="Comma-separated list of options"
                                />
                            )}

                            <div className="flex gap-6">
                                <div className="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        id="is_required"
                                        checked={createForm.data.is_required}
                                        onChange={(e) => createForm.setData('is_required', e.target.checked)}
                                        className="h-4 w-4 rounded"
                                    />
                                    <Label htmlFor="is_required">Required</Label>
                                </div>

                                <div className="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        id="is_visible"
                                        checked={createForm.data.is_visible}
                                        onChange={(e) => createForm.setData('is_visible', e.target.checked)}
                                        className="h-4 w-4 rounded"
                                    />
                                    <Label htmlFor="is_visible">Visible</Label>
                                </div>
                            </div>
                        </div>
                        <DialogFooter>
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => setIsCreateOpen(false)}
                            >
                                Cancel
                            </Button>
                            <Button type="submit" disabled={createForm.processing}>
                                {createForm.processing ? 'Creating...' : 'Create'}
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>

            {/* Edit Dialog */}
            <Dialog open={isEditOpen} onOpenChange={setIsEditOpen}>
                <DialogContent className="max-w-lg">
                    <DialogHeader>
                        <DialogTitle>Edit Checkout Field</DialogTitle>
                        <DialogDescription>Update field configuration</DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleUpdate}>
                        <div className="space-y-4 py-4">
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <Label htmlFor="edit-section">Section *</Label>
                                    <Select
                                        value={editForm.data.section}
                                        onValueChange={(value) => editForm.setData('section', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select section" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {sections.map((section) => (
                                                <SelectItem key={section.value} value={section.value}>
                                                    {section.label}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="edit-type">Field Type *</Label>
                                    <Select
                                        value={editForm.data.type}
                                        onValueChange={(value) => editForm.setData('type', value)}
                                    >
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select type" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {fieldTypes.map((type) => (
                                                <SelectItem key={type.value} value={type.value}>
                                                    {type.label}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>

                            <AdminTextInput
                                label="Field Key"
                                id="edit-field_key"
                                value={editForm.data.field_key}
                                onChange={(e) => editForm.setData('field_key', e.target.value.toLowerCase().replace(/\s+/g, '_'))}
                                required
                                error={editForm.errors.field_key}
                                placeholder="e.g., customer_name"
                                helperText="Unique identifier for this field (lowercase, no spaces)"
                            />

                            <AdminTextInput
                                label="Label"
                                id="edit-label"
                                value={editForm.data.label}
                                onChange={(e) => editForm.setData('label', e.target.value)}
                                required
                                error={editForm.errors.label}
                                placeholder="e.g., Customer Name"
                            />

                            <AdminTextInput
                                label="Placeholder"
                                id="edit-placeholder"
                                value={editForm.data.placeholder}
                                onChange={(e) => editForm.setData('placeholder', e.target.value)}
                                error={editForm.errors.placeholder}
                                placeholder="e.g., Enter your name"
                            />

                            <AdminTextInput
                                label="Sort Order"
                                id="edit-sort_order"
                                type="number"
                                value={editForm.data.sort_order}
                                onChange={(e) => editForm.setData('sort_order', parseInt(e.target.value) || 0)}
                                error={editForm.errors.sort_order}
                                placeholder="0"
                                helperText="Lower numbers appear first"
                            />

                            {(editForm.data.type === 'select' || editForm.data.type === 'radio') && (
                                <AdminTextInput
                                    label="Options"
                                    id="edit-options"
                                    value={editForm.data.options}
                                    onChange={(e) => editForm.setData('options', e.target.value)}
                                    error={editForm.errors.options}
                                    placeholder="Option 1, Option 2, Option 3"
                                    helperText="Comma-separated list of options"
                                />
                            )}

                            <div className="flex gap-6">
                                <div className="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        id="edit-is_required"
                                        checked={editForm.data.is_required}
                                        onChange={(e) => editForm.setData('is_required', e.target.checked)}
                                        className="h-4 w-4 rounded"
                                    />
                                    <Label htmlFor="edit-is_required">Required</Label>
                                </div>

                                <div className="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        id="edit-is_visible"
                                        checked={editForm.data.is_visible}
                                        onChange={(e) => editForm.setData('is_visible', e.target.checked)}
                                        className="h-4 w-4 rounded"
                                    />
                                    <Label htmlFor="edit-is_visible">Visible</Label>
                                </div>
                            </div>
                        </div>
                        <DialogFooter>
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => setIsEditOpen(false)}
                            >
                                Cancel
                            </Button>
                            <Button type="submit" disabled={editForm.processing}>
                                {editForm.processing ? 'Updating...' : 'Update'}
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>

            {/* Delete Dialog */}
            <Dialog open={isDeleteOpen} onOpenChange={setIsDeleteOpen}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Delete Checkout Field</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete the "{selectedField?.label}" field? This action
                            cannot be undone.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" onClick={() => setIsDeleteOpen(false)}>
                            Cancel
                        </Button>
                        <Button variant="destructive" onClick={handleDelete}>
                            Delete
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </>
    );
}

CheckoutFields.layout = (page) => <AdminLayout>{page}</AdminLayout>;
