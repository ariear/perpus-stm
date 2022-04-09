<template>
<div class="flex lg:flex-row flex-col">
    <nav class="bg-[#363740] text-[#A4A6B3] font-mules overflow-auto h-screen sticky top-0 left-0 lg:block hidden">
        <p class="font-bold text-lg flex items-center pt-10 pl-7"><img src="/asset/perpus-logo.png" class="w-[40px] mr-4" alt="">Perpus STM</p>

        <div class="mt-10">
            <router-link to="/dashboard"><p class="py-4 pl-7 pr-28" :class="$route.path == '/dashboard' ? 'bg-[#5b76cf4f]' : '' ">Overview</p></router-link>
            <router-link to="/dashboard/books"><p class="py-4  pl-7 pr-28" :class="$route.path == '/dashboard/books' ? 'bg-[#5b76cf4f]' : '' ">Buku</p></router-link>
            <router-link to="/dashboard/booktypes"><p class="py-4  pl-7 pr-28" :class="$route.path == '/dashboard/booktypes' ? 'bg-[#5b76cf4f]' : '' ">Jenis Buku</p></router-link>
            <router-link to="/dashboard/kelas"><p class="py-4  pl-7 pr-28" :class="$route.path == '/dashboard/kelas' || $route.name == 'datasiswa' ? 'bg-[#5b76cf4f]' : '' ">Kelas</p></router-link>
            <router-link to="/dashboard/peminjaman"><p class="py-4  pl-7 pr-28" :class="$route.name == 'peminjaman' ? 'bg-[#5b76cf4f]' : '' ">Peminjaman</p></router-link>
        </div>
    </nav>

    <!-- nav mobile -->
    <nav class="flex lg:hidden justify-between border items-center px-6 py-3">
        <p class="font-bold text-lg flex items-center"><img src="/asset/perpus-logo.png" class="w-[40px] mr-4" alt="">Perpus STM</p>
        <img src="/asset/hamburger.png" class="w-[40px]" alt="" @click="$store.state.munculmenu = true">
    </nav>
    <transition name="munculmenu">
    <div v-if="$store.state.munculmenu" class="fixed font-mules left-0 top-0 w-screen h-screen bg-white z-30 block lg:hidden">
        <div class="flex justify-end pt-4 pr-4" @click="$store.state.munculmenu = false">
            <img src="/asset/close.png" class="w-[30px]" alt="">
        </div>
            <router-link to="/dashboard"><p class="py-4 pl-7" :class="$route.path == '/dashboard' ? 'bg-[#5b76cf4f]' : '' ">Overview</p></router-link>
            <router-link to="/dashboard/books"><p class="py-4  pl-7" :class="$route.path == '/dashboard/books' ? 'bg-[#5b76cf4f]' : '' ">Buku</p></router-link>
            <router-link to="/dashboard/booktypes"><p class="py-4  pl-7 " :class="$route.path == '/dashboard/booktypes' ? 'bg-[#5b76cf4f]' : '' ">Jenis Buku</p></router-link>
            <router-link to="/dashboard/kelas"><p class="py-4  pl-7" :class="$route.path == '/dashboard/kelas' || $route.name == 'datasiswa' ? 'bg-[#5b76cf4f]' : '' ">Kelas</p></router-link>
            <router-link to="/dashboard/peminjaman"><p class="py-4  pl-7" :class="$route.name == 'peminjaman' ? 'bg-[#5b76cf4f]' : '' ">Peminjaman</p></router-link>
            <button class="ml-7 py-2 px-7 rounded-full bg-red-400 text-white" @click="logout">Logout</button>
    </div>
    </transition>
    <!-- end nav mobile -->

    <div class="flex-grow px-5 xl:px-10">
  <router-view></router-view>
    </div>
</div>
</template>

<script>
export default {
    methods: {
        logout(){
            localStorage.removeItem('token')
            localStorage.removeItem('loggedIn')

            return location.href = '/login'
        }
    },
}
</script>

<style>
.munculmenu-enter-from,
.munculmenu-leave-to{
    opacity: 0;
    transform: translateX(30px);
}
.munculmenu-enter-active,
.munculmenu-leave-active{
    transition: all .3s ease;
}
</style>
