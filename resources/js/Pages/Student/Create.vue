<script setup>
import { ref, shallowRef, onMounted, computed } from 'vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Current year
const currentYear = new Date().getFullYear()

// Create a new book record
function createNewRecord() {
    return {
        id: null,
        title: '',
        author: '',
        genre: '',
        year: currentYear,
        pages: 1,
    }
}

// Reactive data
const books = ref([])
const formModel = ref(createNewRecord())
const dialog = shallowRef(false)
const isEditing = computed(() => !!formModel.value.id)

// Table headers (Vuetify 3 expects `value`)
const headers = [
    { title: 'Title', value: 'title', align: 'start' },
    { title: 'Author', value: 'author' },
    { title: 'Genre', value: 'genre' },
    { title: 'Year', value: 'year', align: 'end' },
    { title: 'Pages', value: 'pages', align: 'end' },
    { title: 'Actions', value: 'actions', align: 'end', sortable: false },
]

// Lifecycle
onMounted(() => {
    reset()
})

// Functions
function add() {
    formModel.value = createNewRecord()
    dialog.value = true
}

function edit(id) {
    const found = books.value.find(book => book.id === id)
    if (!found) return
    formModel.value = { ...found }
    dialog.value = true
}

function remove(id) {
    const index = books.value.findIndex(book => book.id === id)
    if (index !== -1) books.value.splice(index, 1)
}

function save() {
    if (isEditing.value) {
        const index = books.value.findIndex(book => book.id === formModel.value.id)
        if (index !== -1) books.value[index] = { ...formModel.value }
    } else {
        formModel.value.id = books.value.length + 1
        books.value.push({ ...formModel.value })
    }
    dialog.value = false
}

function reset() {
    dialog.value = false
    formModel.value = createNewRecord()
    books.value = [
        { id: 1, title: 'To Kill a Mockingbird', author: 'Harper Lee', genre: 'Fiction', year: 1960, pages: 281 },
        { id: 2, title: '1984', author: 'George Orwell', genre: 'Dystopian', year: 1949, pages: 328 },
        { id: 3, title: 'The Great Gatsby', author: 'F. Scott Fitzgerald', genre: 'Fiction', year: 1925, pages: 180 },
        { id: 4, title: 'Sapiens', author: 'Yuval Noah Harari', genre: 'Non-Fiction', year: 2011, pages: 443 },
        { id: 5, title: 'Dune', author: 'Frank Herbert', genre: 'Sci-Fi', year: 1965, pages: 412 },
    ]
}
</script>

<template>
    <AuthenticatedLayout>
    <h1>Este es Student/Create.vue</h1>

    <v-sheet border rounded class="pa-4">
        <v-data-table
            :headers="headers"
            :items="books"
            :hide-default-footer="books.length < 11"
        >
            <!-- Toolbar -->
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>
                        <v-icon color="medium-emphasis" icon="mdi-book-multiple" size="x-small"></v-icon>
                        Popular Books
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn text rounded @click="add" prepend-icon="mdi-plus">
                        Add a Book
                    </v-btn>
                </v-toolbar>
            </template>

            <!-- Title as chip -->
            <template v-slot:item.title="{ value }">
                <v-chip label border="thin opacity-25" prepend-icon="mdi-book">
                    {{ value }}
                </v-chip>
            </template>

            <!-- Actions -->
            <template v-slot:item.actions="{ item }">
                <div class="d-flex ga-2 justify-end">
                    <v-icon size="small" color="medium-emphasis" icon="mdi-pencil" @click="edit(item.id)"></v-icon>
                    <v-icon size="small" color="medium-emphasis" icon="mdi-delete" @click="remove(item.id)"></v-icon>
                </div>
            </template>

            <!-- No data -->
            <template v-slot:no-data>
                <v-btn text prepend-icon="mdi-backup-restore" @click="reset">
                    Reset data
                </v-btn>
            </template>
        </v-data-table>
    </v-sheet>

    <!-- Dialog form -->
    <v-dialog v-model="dialog" max-width="500">
        <v-card
            :title="`${isEditing ? 'Edit' : 'Add'} a Book`"
            :subtitle="`${isEditing ? 'Update' : 'Create'} your favorite book`"
        >
            <template v-slot:text>
                <v-row>
                    <v-col cols="12">
                        <v-text-field v-model="formModel.title" label="Title"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field v-model="formModel.author" label="Author"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-select
                            v-model="formModel.genre"
                            :items="['Fiction', 'Dystopian', 'Non-Fiction', 'Sci-Fi']"
                            label="Genre"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-number-input
                            v-model="formModel.year"
                            :max="currentYear"
                            :min="1"
                            label="Year"
                        ></v-number-input>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-number-input
                            v-model="formModel.pages"
                            :min="1"
                            label="Pages"
                        ></v-number-input>
                    </v-col>
                </v-row>
            </template>

            <v-divider></v-divider>

            <v-card-actions class="bg-surface-light">
                <v-btn text variant="plain" @click="dialog = false">Cancel</v-btn>
                <v-spacer></v-spacer>
                <v-btn text @click="save">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    </AuthenticatedLayout>
</template>

<style scoped>
.pa-4 {
    padding: 1rem;
}
</style>
