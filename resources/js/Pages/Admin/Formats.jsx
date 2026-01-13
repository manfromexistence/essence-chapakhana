import AdminLayout from '@/Layouts/AdminLayout';
import { useState } from 'react';
import { router, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
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
import { Plus, Pencil, Trash2 } from 'lucide-react';

export default function Formats({ formats = [] }) {
    const [isCreateOpen, setIsCreateOpen] = useState(false);
    const [isEditOpen, setIsEditOpen] = useState(false);
    const [isDeleteOpen, setIsDeleteOpen] = useState(false);
    const [selectedFormat, setSelectedFormat] = useState(null);

    const createForm = useForm({
        name: '',
        is_active: true,
    });

    const editForm = useForm({
        name: '',
        is_active: true,
    });

    const handleCreate = (e) => {
        e.preventDefault();
        createForm.post('/admin/dashboard/formats', {
            onSuccess: () => {
                setIsCreateOpen(false);
                createForm.reset();
            },
        });
    };

    const handleEdit = (format) => {
        setSelectedFormat(format);
        editForm.setData({
            name: format.name,
            is_active: format.is_active,
        });
        setIsEditOpen(true);
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        editForm.put(`/admin/dashboard/formats/${selectedFormat.id}`, {
            onSuccess: () => {
                setIsEditOpen(false);
                editForm.reset();
            },
        });
    };

    const handleDelete = () => {
        router.delete(`/admin/dashboard/formats/${selectedFormat.id}`, {
            onSuccess: () => setIsDeleteOpen(false),
        });
    };

    return (
        <>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Formats</h1>
                        <p className="text-muted-foreground">Manage product formats</p>
                    </div>
                    <Button onClick={() => setIsCreateOpen(true)}>
                        <Plus className="mr-2 h-4 w-4" />
                        Add Format
                    </Button>
                </div>

                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>All Formats</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Status</TableHead>
                                        <TableHead className="text-right">Actions</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {formats.map((format) => (
                                        <TableRow key={format.id}>
                                            <TableCell className="font-medium">{format.name}</TableCell>
                                            <TableCell>
                                                <Badge variant={format.is_active ? 'default' : 'secondary'}>
                                                    {format.is_active ? 'Active' : 'Inactive'}
                                                </Badge>
                                            </TableCell>
                                            <TableCell className="text-right">
                                                <div className="flex justify-end gap-2">
                                                    <Button
                                                        variant="outline"
                                                        size="sm"
                                                        onClick={() => handleEdit(format)}
                                                    >
                                                        <Pencil className="h-4 w-4" />
                                                    </Button>
                                                    <Button
                                                        variant="destructive"
                                                        size="sm"
                                                        onClick={() => {
                                                            setSelectedFormat(format);
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
                </div>
            </div>

            {/* Create Dialog */}
            <Dialog open={isCreateOpen} onOpenChange={setIsCreateOpen}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Create Format</DialogTitle>
                        <DialogDescription>Add a new product format</DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleCreate}>
                        <div className="space-y-4 py-4">
                            <AdminTextInput
                                label="Name"
                                id="name"
                                value={createForm.data.name}
                                onChange={(e) => createForm.setData('name', e.target.value)}
                                minLength={2}
                                maxLength={50}
                                required
                                error={createForm.errors.name}
                                placeholder="e.g., Paperback, Hardcover"
                            />
                            <div className="flex items-center space-x-2">
                                <input
                                    type="checkbox"
                                    id="is_active"
                                    checked={createForm.data.is_active}
                                    onChange={(e) =>
                                        createForm.setData('is_active', e.target.checked)
                                    }
                                    className="h-4 w-4 rounded"
                                />
                                <Label htmlFor="is_active">Active</Label>
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
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Edit Format</DialogTitle>
                        <DialogDescription>Update format details</DialogDescription>
                    </DialogHeader>
                    <form onSubmit={handleUpdate}>
                        <div className="space-y-4 py-4">
                            <AdminTextInput
                                label="Name"
                                id="edit-name"
                                value={editForm.data.name}
                                onChange={(e) => editForm.setData('name', e.target.value)}
                                defaultValue={selectedFormat?.name}
                                minLength={2}
                                maxLength={50}
                                required
                                error={editForm.errors.name}
                                placeholder="Enter format name"
                            />
                            <div className="flex items-center space-x-2">
                                <input
                                    type="checkbox"
                                    id="edit-is_active"
                                    checked={editForm.data.is_active}
                                    onChange={(e) =>
                                        editForm.setData('is_active', e.target.checked)
                                    }
                                    className="h-4 w-4 rounded"
                                />
                                <Label htmlFor="edit-is_active">Active</Label>
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
                        <DialogTitle>Delete Format</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete "{selectedFormat?.name}"? This action
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

Formats.layout = (page) => <AdminLayout>{page}</AdminLayout>;
