import { useForm } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post('/admin/login');
    };

    return (
        <div className="relative flex min-h-screen items-center justify-center overflow-hidden p-4">
            {/* Animated gradient background */}
            <div className="absolute inset-0 bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700">
                <div className="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE2YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00em0wIDI0YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00ek0xMiAxNmMwLTIuMjEgMS43OS00IDQtNHM0IDEuNzkgNCA0LTEuNzkgNC00IDQtNC0xLjc5LTQtNHptMCAyNGMwLTIuMjEgMS43OS00IDQtNHM0IDEuNzkgNCA0LTEuNzkgNC00IDQtNC0xLjc5LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30"></div>
            </div>

            {/* Floating shapes for visual interest */}
            <div className="absolute inset-0 overflow-hidden pointer-events-none">
                <motion.div
                    className="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"
                    animate={{
                        x: [0, 100, 0],
                        y: [0, 50, 0],
                    }}
                    transition={{
                        duration: 20,
                        repeat: Infinity,
                        ease: "easeInOut"
                    }}
                />
                <motion.div
                    className="absolute bottom-20 right-10 w-96 h-96 bg-purple-300/10 rounded-full blur-3xl"
                    animate={{
                        x: [0, -100, 0],
                        y: [0, -50, 0],
                    }}
                    transition={{
                        duration: 25,
                        repeat: Infinity,
                        ease: "easeInOut"
                    }}
                />
            </div>

            <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, ease: "easeOut" }}
                className="relative z-10 w-full max-w-md"
            >
                {/* Logo container */}
                <motion.div
                    initial={{ opacity: 0, scale: 0.9 }}
                    animate={{ opacity: 1, scale: 1 }}
                    transition={{ duration: 0.5, delay: 0.2 }}
                    className="mb-8 text-center"
                >
                    <div className="inline-block p-4 bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl">
                        <img 
                            src="/logo.png" 
                            alt="Chapakhana Logo" 
                            className="h-20 w-auto mx-auto"
                        />
                    </div>
                </motion.div>

                {/* Glassmorphism card */}
                <Card className="border-0 bg-white/95 backdrop-blur-xl shadow-2xl">
                    <CardHeader className="space-y-2 pb-6">
                        <CardTitle className="text-3xl font-bold text-center bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                            Admin Portal
                        </CardTitle>
                        <CardDescription className="text-center text-base">
                            Enter your credentials to access the dashboard
                        </CardDescription>
                    </CardHeader>
                    <CardContent className="pb-8">
                        <form onSubmit={submit} className="space-y-5">
                            <motion.div
                                initial={{ opacity: 0, x: -20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.4, delay: 0.3 }}
                            >
                                <AdminTextInput
                                    label="Email Address"
                                    id="email"
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="admin@chapakhana.com"
                                    required
                                    autoFocus
                                    error={errors.email}
                                    showCharCount={false}
                                />
                            </motion.div>

                            <motion.div
                                initial={{ opacity: 0, x: -20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.4, delay: 0.4 }}
                            >
                                <AdminTextInput
                                    label="Password"
                                    id="password"
                                    type="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    placeholder="Enter your password"
                                    required
                                    error={errors.password}
                                    showCharCount={false}
                                />
                            </motion.div>

                            <motion.div
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                transition={{ duration: 0.4, delay: 0.5 }}
                                className="flex items-center space-x-2"
                            >
                                <input
                                    id="remember"
                                    type="checkbox"
                                    checked={data.remember}
                                    onChange={(e) => setData('remember', e.target.checked)}
                                    className="h-4 w-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500 focus:ring-offset-0 transition-colors cursor-pointer"
                                />
                                <Label htmlFor="remember" className="text-sm font-normal cursor-pointer select-none">
                                    Remember me for 30 days
                                </Label>
                            </motion.div>

                            <motion.div
                                initial={{ opacity: 0, y: 10 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.4, delay: 0.6 }}
                            >
                                <Button 
                                    type="submit" 
                                    className="w-full h-11 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]" 
                                    disabled={processing}
                                >
                                    {processing ? (
                                        <span className="flex items-center justify-center gap-2">
                                            <svg className="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Signing in...
                                        </span>
                                    ) : (
                                        'Sign in to Dashboard'
                                    )}
                                </Button>
                            </motion.div>
                        </form>
                    </CardContent>
                </Card>

                {/* Footer text */}
                <motion.p
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ duration: 0.5, delay: 0.8 }}
                    className="mt-6 text-center text-sm text-white/90"
                >
                    © {new Date().getFullYear()} Chapakhana. All rights reserved.
                </motion.p>
            </motion.div>
        </div>
    );
}
