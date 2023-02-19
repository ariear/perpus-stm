<template>

<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alert" @click="alert = false">
        <p>Terimakasih , Buku sudah dikembalikan</p>
    </div>
</transition>

  <nav class="flex justify-between font-mules pt-10">
      <p class="font-semibold text-2xl">Overview</p>
      <div class="flex items-center">
        <p class="pl-5 lg:mr-4">{{ nama }}</p>
        <button class="py-2 px-7 rounded-full bg-red-400 text-white hidden lg:block" @click="logout">Logout</button>
      </div>
  </nav>
  <div class="flex flex-wrap font-mules md:justify-start justify-center text-center mt-16">
      <div class="w-[90%] md:w-[40%] lg:w-[20%] border rounded-xl py-6 md:mr-7 group hover:border-[#3751FF] transition-all">
          <p class="text-[#9FA2B4] text-xl font-bold mb-4 group-hover:text-[#3751FF]">Buku</p>
          <p class="font-bold text-[#252733] text-4xl group-hover:text-[#3751FF]">{{ countbuku }}</p>
      </div>
      <div class="w-[90%] md:w-[40%] mt-5 md:mt-0 lg:w-[20%] border rounded-xl py-6 md:mr-7 group hover:border-[#3751FF] transition-all">
          <p class="text-[#9FA2B4] text-xl font-bold mb-4 group-hover:text-[#3751FF]">Jenis Buku</p>
          <p class="font-bold text-[#252733] text-4xl group-hover:text-[#3751FF]">{{ jenisbuku }}</p>
      </div>
      <div class="w-[90%] md:w-[40%] mt-5 lg:mt-0 lg:w-[20%] border rounded-xl py-6 md:mr-7 group hover:border-[#3751FF] transition-all">
          <p class="text-[#9FA2B4] text-xl font-bold mb-4 group-hover:text-[#3751FF]">Peminjam</p>
          <p class="font-bold text-[#252733] text-4xl group-hover:text-[#3751FF]">{{ peminjam }}</p>
      </div>
      <div class="w-[90%] md:w-[40%] mt-5 lg:mt-0 lg:w-[20%] border rounded-xl py-6 group hover:border-[#3751FF] transition-all">
          <p class="text-[#9FA2B4] text-xl font-bold mb-4 group-hover:text-[#3751FF]">Telat</p>
          <p class="font-bold text-[#252733] text-4xl group-hover:text-[#3751FF]">{{ telat }}</p>
      </div>
  </div>

<!-- table -->
<div class="font-mules mt-10 border w-[90vw] lg:w-[700px] xl:w-max rounded-xl shadow-lg overflow-auto">
    <table>
        <thead class="border border-b">
            <tr>
                <th class="py-3">NIK</th>
                <th class="py-3">NAMA</th>
                <th class="py-3">KELAS</th>
                <th class="py-3">BUKU</th>
                <th class="py-3">TGL PINJAM</th>
                <th class="py-3">TGL KEMBALI</th>
                <th class="py-3">STATUS</th>
                <th class="py-3 px-3">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center" v-for="peminjam in dataPeminjam" :key="peminjam.id">
                <td class="py-5 px-3 border-t" v-text="peminjam.nik"></td>
                <td class="py-5 px-3 border-t" v-text="peminjam.nama"></td>
                <td class="py-5 px-3 border-t" v-text="peminjam.kelas"></td>
                <td class="py-5 px-3 border-t" v-text="peminjam.namabuku"></td>
                <td class="py-5 px-5 border-t" v-text="peminjam.haripinjam"></td>
                <td class="py-5 px-3 border-t" v-text="peminjam.harikembali"></td>
                <td class="py-5 px-3 border-t"><p class="py-2 px-3 text-sm text-white rounded-full" :class="peminjam.status == 'Pinjam' ? 'bg-blue-400' : 'bg-red-400' " v-text="peminjam.status"></p></td>
                <td class="py-5 px-3 border-t">
                    <button type="submit" class="py-2 px-4 rounded-full bg-green-400 text-white text-sm" @click="kembalikan(peminjam.id)">DiKembalikan?</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- end table -->
<div class="pb-10"></div>
</template>

<script>
import axios from "axios"
export default {
    data() {
        return {
            nama: '',
            dataPeminjam: [],
            telat: {
                dasar: ''
            },
            alert: false,
            countbuku: '',
            jenisbuku: '',
            peminjam : '',
            telat: ''
        }
    },
    async created() {
        await axios.get('http://localhost:8000/api/user',  {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
        .then(response => {
            this.nama = response.data.nama
        })
    },
    methods: {
        async getPeminjaman(){
            await axios.get('http://localhost:8000/api/peminjaman', {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.dataPeminjam = response.data.data
                })
        },
        async pastelat(){
            await axios.put('http://localhost:8000/api/peminjaman', this.telat  , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
        },
        async kembalikan(id){
            await axios.delete(`http://localhost:8000/api/peminjaman/${id}`,  {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.alert = true
                    this.getPeminjaman()
                    this.getCountData()
                    setTimeout(() => {
                        this.alert = false
                    }, 3000);
                })
        },
        logout(){
            localStorage.removeItem('token')
            localStorage.removeItem('loggedIn')

            return location.href = '/login'
        },
        async getCountData(){
            await axios.get('http://localhost:8000/api/count', {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.countbuku = response.data.buku.length
                    this.jenisbuku = response.data.jenisbuku.length
                    this.peminjam = response.data.peminjam.length
                    this.telat = response.data.telat.length
                })
        }
    },
    mounted() {
        this.$store.state.munculmenu = false
        this.pastelat()
        if (!this.$store.state.loggedIn) {
            return this.$router.push('/login')
        }
        this.getPeminjaman()
        this.getCountData()
    },
}
</script>
