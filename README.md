## **DESARROLLO DE SOFTWARE 1P**


```bash
composer create-project laravel/Laravel "NAME"
```

```terminal
composer require laravel/breeze --dev
```
---------------------

```terminal
php artisan breeze:install 
```
select: `vue` -> `dark` -> `none` (/n)

---------------------

```terminal
php artisan migrate
```
---------------------

```terminal
npm install --force
npm install --legacy-peer-deps
```

---------------------

```terminal
npm run dev
```
```terminal
php artisan serve
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

replace `resources/js/app.js` for:

```js
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



en `js/Plugins/vuetify.js` (create dir \& js if necessary):

```js
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

---------------------

add these imports to `routes/web.php`

```php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
```



and add routes in the following format:
```php
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/edit', [CourseController::class, 'edit'])->name('courses.edit');
```
---------------------

to make them visible for auth users only, add the `Route:get` INSIDE the `middleware` like this
```php
Route::middleware('auth')->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('/courses/edit', [CourseController::class, 'edit'])->name('courses.edit');
}
```
to make them visible for auth and guest users, add the `Route:get` OUTSIDE the `middleware` like this

```php
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/edit', [CourseController::class, 'edit'])->name('courses.edit');

Route::middleware('auth')->group(function () {
    . . .
}
```
---------------------


template for `Course/Index.vue`:

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
---------------------



template for NavLinks on `AuthenticatedLayout.vue`:

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

---------------------


to create the side panel, first add this import to `<script>` on `AuthenticatedLayout.vue` for the icons to work
```vue
<script>
    <!-- The rest of the file stayus the same, copy only the import -->
    import '@mdi/font/css/materialdesignicons.css'
</script>
```

then add the `<v-card>` at the end of the `<template>` on `AuthenticatedLayout.vue`

```vue
<template>
    <div>
        <!-- The rest of the file stayus the same, copy only the <v-card> -->
    </div>

    <v-card>
        <v-layout>
            <v-navigation-drawer expand-on-hover permanent rail>
                <v-list>
                    <v-list-item
                        prepend-avatar="https://randomuser.me/api/portraits/women/1.jpg"
                        :subtitle="$page.props.auth?.user?.email || ''"
                        :title="$page.props.auth?.user?.name || 'Guest'"
                    ></v-list-item>
                </v-list>

                <v-divider></v-divider>

                <v-list nav density="comfortable">
                    <Link
                        :href="route('student.index')"
                        :active="route().current('student.index')"
                    >
                        <v-list-item
                            prepend-icon="mdi-account-school"
                            title="Student"
                        />
                    </Link>

                    <Link
                        :href="route('courses.index')"
                        :active="route().current('courses.index')"
                    >
                        <v-list-item
                            prepend-icon="mdi-book-open-variant"
                            title="Courses"
                        />
                    </Link>

                    <Link
                        :href="route('course_offer.index')"
                        :active="route().current('course_offer.index')"
                    >
                        <v-list-item
                            prepend-icon="mdi-book-plus"
                            title="Course Offer"
                        />
                    </Link>

                    <Link
                        :href="route('faculty.index')"
                        :active="route().current('faculty.index')"
                    >
                        <v-list-item
                            prepend-icon="mdi-account-tie"
                            title="Faculties"
                        />
                    </Link>

                    <Link
                        :href="route('period.index')"
                        :active="route().current('period.index')"
                    >
                        <v-list-item
                            prepend-icon="mdi-calendar-clock"
                            title="Period"
                        />
                    </Link>

                </v-list>
            </v-navigation-drawer>

            <v-main style="height: 250px"></v-main>
        </v-layout>
    </v-card>
</template>

```
---------------------

icons can be found at
https://pictogrammers.com/library/mdi/



while looking for icons, select `WEBFONT` when looking at the code and copy the `class`, e.g.:
```webfont
<span class="mdi mdi-abacus"></span>
```



paste just `mdi-abacus` to `prepend-icon` on the `<v-list-item>`
```vue
<Link
    :href="route('abacus.index')"
    :active="route().current('abacus.index')"
>
    <v-list-item
        prepend-icon="mdi-abacus"
        title="Abacus"
    />
</Link>
```

---------------------

add `AuthenticatedLayout` to every vue page so the side panel and navigation bar are visible


first import the layout on `<script>`
```vue
<script>
    <!-- The rest of the file stayus the same, copy only the import -->
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>
```



then add `<AuthenticatedLayout>` as a label at the start and end of `<template>` (remember to add the slash to close `</AuthenticatedLayout>`). E.g. of `Courses/Index.vue`:
```vue
<template>
    <AuthenticatedLayout>

    <div class="d-flex justify-center ga-2">
        <h1>Este es Courses/Index.vue</h1>
    </div>

    </AuthenticatedLayout>
</template>
```
---------------------
