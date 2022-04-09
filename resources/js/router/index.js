import { createRouter , createWebHistory } from "vue-router"
import Home from '../views/Home.vue'
import Book from '../views/Book.vue'
import Login from '../views/auth/Login.vue'
import Sidebar from '../component/Sidebar.vue'
import BookType from '../views/BookType.vue'
import Kelas from '../views/Kelas.vue'
import DataSiswa from '../views/DataSiswa.vue'
import Peminjaman from '../views/Peminjaman.vue'

const routes = [
    {
        path: '/dashboard',
        component: Sidebar,
        children:[
            {
                path: '',
                component: Home
            },
            {
                path: 'books',
                component: Book
            },
            {
                path: 'booktypes',
                component: BookType
            },
            {
                path: 'kelas',
                component: Kelas
            },
            {
                path: 'kelas/:id/siswa',
                component: DataSiswa,
                name: 'datasiswa'
            },
            {
                path: 'peminjaman',
                component: Peminjaman,
                name: 'peminjaman'
            }
        ]
    },
    {
        path: '/login',
        component: Login
    }
]

const router = createRouter({
    'history' : createWebHistory(),
    routes
})

export default router
