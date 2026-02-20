## **DESARROLLO DE SOFTWARE 1P**


```bash
composer create-project laravel/Laravel "NAME"
```
---------------------

```terminal
composer require laravel/breeze --dev
```
---------------------

```terminal
php artisan breeze:install 
```
select: 'vue' -> dark -> none (/n)

---------------------

```terminal
php artisan migrate
```
---------------------

```terminal
npm install --force  /  --legacy-peer-deps
```

---------------------

```terminal
npm run dev  ||  php artisan serve
```
(each on a different terminal)

---------------------
```terminal
npm install vuetify --legacy-peer-deps
```

```terminal
npm install @mdi/font --force
```

---------------------


replace 'resources/js/app.js' for:

```vue
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import vuetify from './Plugins/vuetify';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)   // Inertia plugin
            .use(ZiggyVue) // Ziggy for Laravel named routes
            .use(vuetify)  // Vuetify plugin
            .mount(el);
    },

    progress: {
        color: '#4B5563',
        showSpinner: true,
    },
});
```



en 'js/Plugins/vuetify.js' (create dir \& js if null):

```vue
// Vuetify configuration
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { mdi } from 'vuetify/iconsets/mdi'

export default createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        sets: { mdi },
    },
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#22c55e',
                    secondary: '#fbbf24',
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#ffffff',
                    surface: '#ffffff',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#2d3748',
                    'on-surface': '#2d3748',
                    'grey-50': '#f9fafb',
                    'grey-100': '#f3f4f6',
                    'grey-200': '#e5e7eb',
                    'grey-300': '#d1d5db',
                    'grey-400': '#9ca3af',
                    'grey-500': '#6b7280',
                    'grey-600': '#4b5563',
                    'grey-700': '#374151',
                    'grey-800': '#1f2937',
                    'grey-900': '#111827',
                },
            },
            dark: {
                dark: true,
                colors: {
                    primary: '#22c55e',
                    secondary: '#fbbf24',
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#1f2937',
                    surface: '#374151',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#f9fafb',
                    'on-surface': '#f9fafb',
                },
            },
        },
    },
})
```



add to 'routes/web.php':

```vue
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/edit', [CourseController::class, 'edit'])->name('courses.edit');
```



template for 'Course/Index.vue':

```vue
<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="d-flex justify-center ga-2">
    <h1>Este es Courses/Index.vue</h1>
    </div>

    <div class="d-flex justify-center">
        <Link href="/courses/create">
            <v-btn>Ir a /Create</v-btn>
        </Link>

        <Link href="/courses/edit">
            <v-btn>Ir a /Edit</v-btn>
        </Link>
    </div>
</template>
```



template for NavLinks on 'AuthenticatedLayout.vue':

```vue
<script setup>
import { NavLink } from '@inertiajs/vue3';
</script>

<template>
    <NavLink
        :href="route('courses.index')"
        :active="route().current('courses.index')"
    >
        Courses
    </NavLink>
</template>
```




