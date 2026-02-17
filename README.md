###### **DESARROLLO DE SOFTWARE 1P**



composer create-project laravel/Laravel "NAME"



composer require laravel/breeze --dev



php artisan breeze:install

(vue ... dark ... /n)



php artisan migrate



npm install --force  /  --legacy-peer-deps



npm run dev  ||  php artisan serve



========================================



npm install vuetify --legacy-peer-deps



npm install @mdi/font --force



========================================



replace 'resources/js/app.js' for:

|<br />import './bootstrap';<br />import '../css/app.css';<br /><br />import { createApp, h } from 'vue';<br />import { createInertiaApp } from '@inertiajs/vue3';<br />import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';<br />import { ZiggyVue } from '../../vendor/tightenco/ziggy';<br /><br />import vuetify from './Plugins/vuetify';<br /><br />const appName = import.meta.env.VITE\_APP\_NAME \|\| 'Laravel';<br /><br />createInertiaApp({<br />    title: (title) => `${title} - ${appName}`,<br /><br />    resolve: (name) =><br />        resolvePageComponent(<br />            `./Pages/${name}.vue`,<br />            import.meta.glob('./Pages/\*\*/\*.vue')<br />        ),<br /><br />    setup({ el, App, props, plugin }) {<br />        return createApp({ render: () => h(App, props) })<br />            .use(plugin)   // Inertia plugin<br />            .use(ZiggyVue) // Ziggy for Laravel named routes<br />            .use(vuetify)  // Vuetify plugin<br />            .mount(el);<br />    },<br /><br />    progress: {<br />        color: '#4B5563',<br />        showSpinner: true,<br />    },<br />});<br />|
|-|



en 'js/Plugins/vuetify.js' (create dir \& js if null):

|<br />// Vuetify configuration<br />import 'vuetify/styles'<br />import { createVuetify } from 'vuetify'<br />import \* as components from 'vuetify/components'<br />import \* as directives from 'vuetify/directives'<br />import { mdi } from 'vuetify/iconsets/mdi'<br /><br />export default createVuetify({<br />    components,<br />    directives,<br />    icons: {<br />        defaultSet: 'mdi',<br />        sets: { mdi },<br />    },<br />    theme: {<br />        defaultTheme: 'light',<br />        themes: {<br />            light: {<br />                dark: false,<br />                colors: {<br />                    primary: '#22c55e',<br />                    secondary: '#fbbf24',<br />                    accent: '#22c55e',<br />                    error: '#ef4444',<br />                    info: '#3b82f6',<br />                    success: '#10b981',<br />                    warning: '#f59e0b',<br />                    background: '#ffffff',<br />                    surface: '#ffffff',<br />                    'on-primary': '#ffffff',<br />                    'on-secondary': '#1f2937',<br />                    'on-background': '#2d3748',<br />                    'on-surface': '#2d3748',<br />                    'grey-50': '#f9fafb',<br />                    'grey-100': '#f3f4f6',<br />                    'grey-200': '#e5e7eb',<br />                    'grey-300': '#d1d5db',<br />                    'grey-400': '#9ca3af',<br />                    'grey-500': '#6b7280',<br />                    'grey-600': '#4b5563',<br />                    'grey-700': '#374151',<br />                    'grey-800': '#1f2937',<br />                    'grey-900': '#111827',<br />                },<br />            },<br />            dark: {<br />                dark: true,<br />                colors: {<br />                    primary: '#22c55e',<br />                    secondary: '#fbbf24',<br />                    accent: '#22c55e',<br />                    error: '#ef4444',<br />                    info: '#3b82f6',<br />                    success: '#10b981',<br />                    warning: '#f59e0b',<br />                    background: '#1f2937',<br />                    surface: '#374151',<br />                    'on-primary': '#ffffff',<br />                    'on-secondary': '#1f2937',<br />                    'on-background': '#f9fafb',<br />                    'on-surface': '#f9fafb',<br />                },<br />            },<br />        },<br />    },<br />})<br />|
|-|





add to 'routes/web.php':

|<br />use App\\Http\\Controllers\\StudentController;<br />use App\\Http\\Controllers\\CourseController;<br /><br />Route::get('/courses', \[CourseController::class, 'index'])->name('courses.index');<br />Route::get('/courses/create', \[CourseController::class, 'create'])->name('courses.create');<br />Route::get('/courses/edit', \[CourseController::class, 'edit'])->name('courses.edit');<br />|
|-|



template for 'Course/Index.vue':

|<br /><script setup><br />    import { Link } from '@inertiajs/vue3'<br /></script><br /><br /><template><br />    <div class="d-flex justify-center ga-2"><br />    <h1>Este es Courses/Index.vue</h1><br />    </div><br /><br />    <div class="d-flex justify-center"><br />        <Link href="/courses/create"><br />            <v-btn>Ir a /Create</v-btn><br />        </Link><br /><br />        <Link href="/courses/edit"><br />            <v-btn>Ir a /Edit</v-btn><br />        </Link><br />    </div><br /></template><br />|
|-|



template for NavLinks on 'AuthenticatedLayout.vue':

|<br /><script setup><br />import { NavLink } from '@inertiajs/vue3';<br /></script><br /><br /><template><br />    <NavLink<br />        :href="route('courses.index')"<br />        :active="route().current('courses.index')"<br />    ><br />        Courses<br />    </NavLink><br /></template><br />|
|-|



