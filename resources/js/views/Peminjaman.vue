<template>
  <p class="font-semibold text-3xl mb-5 font-mules pt-10">Peminjaman</p>

<transition name="alert">
    <div class="fixed font-mules right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alert" @click="alert = false">
        <p>Berhasil di pinjam</p>
    </div>
</transition>

  <div class="font-mules mt-10">
      <form @submit.prevent="tambahpeminjam">
      <div class="flex md:flex-row flex-col items-center mb-8">
        <div class="flex flex-col md:mr-8 md:mb-0 mb-4">
        <label for="kelas" class="font-medium">KELAS</label>
        <select id="kelas" v-model="form.kelas" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[90vw] md:w-[300px]">
            <option value=""></option>
            <option v-for="kelas in datakelas" :key="kelas.id" :value="kelas.id">{{ kelas.kelas }}</option>
        </select>
        <p v-if="formerror.kelas" class="text-red-500 text-sm">{{ formerror.kelas[0] }}</p>
        </div>
        <div v-if="form.kelas" class="flex flex-col md:mr-8 md:mb-0 mb-4">
            <label for="nama">SISWA</label>
            <select id="nama" v-model="form.nama" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[90vw] md:w-[300px]">
            <option value=""></option>
            <option v-for="siswa in dataSiswa" :key="siswa.id" :value="siswa.nama">{{ siswa.nama }}</option>
            </select>
            <p v-if="formerror.nama" class="text-red-500 text-sm">{{ formerror.nama[0] }}</p>
        </div>
          <div class="flex flex-col">
          <label for="buku">BUKU</label>
          <select id="buku" v-model="form.namabuku" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[90vw] md:w-[300px]">
              <option value=""></option>
              <option v-for="buku in dataBuku" :key="buku" :value="buku.title">{{ buku.title }}</option>
          </select>
          <p v-if="formerror.namabuku" class="text-red-500 text-sm">{{ formerror.namabuku[0] }}</p>
        </div>
      </div>
      <div class="flex items-center md:flex-row flex-col">
      <div class="flex flex-col md:mr-8 md:mb-0 mb-4">
          <label for="haripinjam">TGL PINJAM</label>
          <input type="date" v-model="form.haripinjam" id="haripinjam" class="w-[90vw] md:w-[300px] border p-3 rounded-lg mt-3">
          <p v-if="formerror.haripinjam" class="text-red-500 text-sm">{{ formerror.haripinjam[0] }}</p>
      </div>
      <div class="flex flex-col">
          <label for="harikembali">TGL KEMBALI</label>
          <input type="date" v-model="form.harikembali" id="harikembali" class="w-[90vw] md:w-[300px] border p-3 rounded-lg mt-3">
          <p v-if="formerror.harikembali" class="text-red-500 text-sm">{{ formerror.harikembali[0] }}</p>
      </div>
      </div>
      <div class="flex justify-center md:justify-start">
      <button type="submit" class="py-3 px-7 rounded-lg bg-[#363740] text-white mt-10 md:mt-5 md:w-max w-[90vw]">PINJAM</button>
      </div>
      </form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      datakelas: [],
      form: {
          nama: '',
          kelas: '',
          namabuku: '',
          haripinjam: null,
          harikembali: null
      },
      dataSiswa: [],
      dataBuku: [],
      alert: false,
      formerror: []
    }
  },
    methods: {
        async getKelas(){
            await axios.get('http://perpustakaan.test/api/kelas', {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(resposne => {
                    this.datakelas = resposne.data.data
                })
        },
        async getSiswa(){
                await axios.get(`http://perpustakaan.test/api/siswa/${this.form.kelas}` , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response => {
                        this.dataSiswa = response.data.data
                    })
        },
        async tambahpeminjam(){
            try {
                await axios.post('http://perpustakaan.test/api/peminjaman', this.form, {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response => {
                        this.alert = true
                        this.form = {
                            nama: '',
                            kelas: '',
                            namabuku : '',
                            haripinjam: null,
                            harikembali: null
                        }
                        setTimeout(() => {
                            this.alert = false
                        }, 3000);
                    })
            } catch (error) {
                this.formerror = error.response.data.errors
            }
        },
        async getBook(){
            await axios.get('http://perpustakaan.test/api/books', {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.dataBuku = response.data.data
                })
        }
    },
    mounted() {
        if (!this.$store.state.loggedIn) {
            return this.$router.push('/login')
        }
        this.$store.state.munculmenu = false
        this.getKelas()
        this.getBook()
    },
    updated() {
        this.getSiswa()
    },
}
</script>
