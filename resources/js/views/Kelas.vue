<template>
<div class="font-mules mb-10">
  <p class="pt-10 font-semibold text-3xl mb-5">Kelas</p>
  <button class="py-3 px-4 rounded-lg bg-[#363740] text-white" @click="bukatambah = true">Tambah Siswa</button>
</div>

<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alert" @click="alert = false">
        <p>Siswa berhasil ditambahkan</p>
    </div>
</transition>

<transition name="tutupform">
    <div v-if="bukatambah" class="fixed top-0 left-0 w-screen h-screen bg-[#0004] z-10" @click="bukatambah = false"></div>
</transition>
<transition name="formtambah">
  <div v-if="bukatambah" class="fixed p-4 rounded-xl h-max bg-white top-0 bottom-0 left-0 right-0 m-auto w-[90vw] md:w-max z-20 font-mules">
      <p class="font-medium text-lg mb-5">Tambah Siswa Baru</p>
      <form @submit.prevent="tambahsiswa">
      <div class="mb-5">
      <label for="nik" class="font-light flex flex-col">NIK</label>
      <input type="text" v-model="form.nik" id="nik" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-full md:w-[300px]">
      <p v-if="formerror.nik" class="text-red-500 text-sm">{{ formerror.nik[0] }}</p>
      </div>
      <div class="mb-5">
      <label for="nama" class="font-light flex flex-col">Nama</label>
      <input type="text" v-model="form.nama" id="nama" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-full md:w-[300px]">
      <p v-if="formerror.nama" class="text-red-500 text-sm">{{ formerror.nama[0] }}</p>
      </div>
    <div class="mb-5">
      <label for="kelas_id" class="font-light flex flex-col">Kelas</label>
      <select id="kelas_id" v-model="form.kelas_id" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-full md:w-[300px]">
          <option value=""></option>
          <option v-for="kela in kelas" :key="kela.id" :value="kela.id">{{ kela.kelas }}</option>
      </select>
      <p v-if="formerror.kelas_id" class="text-red-500 text-sm">{{ formerror.kelas_id[0] }}</p>
      </div>
      <button type="submit" class="py-2 px-7 rounded-xl bg-green-400">Tambah</button>
      </form>
  </div>
</transition>

<div class="flex flex-wrap font-mules">
    <div v-for="kela in kelas" :key="kela.id" class="mr-3 mt-3 p-3 xl:p-5 rounded-lg bg-white shadow-lg hover:bg-[#3751FF] hover:text-white hover:-translate-y-1 transition-all">
    <router-link :to="'/dashboard/kelas/' + kela.id + '/siswa'">
        <p class="text-lg xl:text-xl">{{ kela.kelas }}</p>
    </router-link>
    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            bukatambah: false,
            kelas: [],
            form: {
                nik: '',
                nama: '',
                kelas_id: ''
            },
            formerror: [],
            alert : false
        }
    },
    methods: {
        async getkelas(){
            await axios.get('http://localhost:8000/api/kelas',{headers: {'Authorization': 'Bearer '+this.$store.state.token}})
            .then(response => {
                this.kelas = response.data.data
            })
        },
        async tambahsiswa(){
            try {
                await axios.post('http://localhost:8000/api/siswa', this.form , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.alert = true
                    this.bukatambah = false
                    setTimeout(() => {
                        this.alert = false
                    }, 3000);
                })
            } catch (error) {
                this.formerror = error.response.data.errors
            }
        }
    },
    mounted() {
        if (!this.$store.state.loggedIn) {
            return this.$router.push('/login')
        }
        this.$store.state.munculmenu = false
        this.getkelas()
    },
}
</script>

<style>
.formtambah-enter-from{
    opacity: 0;
    transform: scale(.7);
}
.formtambah-enter-active,
.formtambah-leave-active,
.tutupform-leave-active,
.tutupform-enter-active,
.alert-enter-active,
.alert-leave-active{
    transition: all .2s;
}
.formtambah-leave-to{
    opacity: 0;
    transform: translateY(30px);
}

.tutupform-enter-from{
    opacity: 0;
}
.tutupform-leave-to{
    opacity: 0;
}

.alert-enter-from {
    opacity: 0;
    transform: translateX(30px);
}
.alert-leave-to{
    opacity: 0;
    transform: translateX(30px);
}
</style>
