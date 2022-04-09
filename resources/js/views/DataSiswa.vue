<template>
  <p class="pt-10 font-semibold text-3xl mb-5 font-mules">Siswa Kelas {{ kelas }} </p>

<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alerthapus" @click="alerthapus = false">
        <p>Siswa berhasil dihapus</p>
    </div>
</transition>
<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alertedit" @click="alertedit = false">
        <p>Data Siswa berhasil diperbarui</p>
    </div>
</transition>

<!-- edit siswa -->
<transition name="tutupform">
    <div v-if="bukaedit" class="fixed top-0 left-0 w-screen h-screen bg-[#0004] z-10" @click="bukaedit = false"></div>
</transition>
<transition name="formtambah">
  <div v-if="bukaedit" class="fixed p-4 rounded-xl h-max bg-white top-0 bottom-0 left-0 right-0 m-auto w-max z-20 font-mules">
      <p class="font-medium text-lg mb-5">Edit Siswa</p>
      <form @submit.prevent="editsiswa">
      <div class="mb-5">
      <label for="nik" class="font-light flex flex-col">NIK</label>
      <input type="text" v-model="form.nik" id="nik" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[300px]">
      <p v-if="formerror.nik" class="text-red-500 text-sm">{{ formerror.nik[0] }}</p>
      </div>
      <div class="mb-5">
      <label for="nama" class="font-light flex flex-col">Nama</label>
      <input type="text" v-model="form.nama" id="nama" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[300px]">
      <p v-if="formerror.nama" class="text-red-500 text-sm">{{ formerror.nama[0] }}</p>
      </div>
    <div class="mb-5">
      <label for="kelas_id" class="font-light flex flex-col">Kelas</label>
      <select id="kelas_id" v-model="form.kelas_id" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[300px]">
          <option value=""></option>
          <option v-for="kela in listkelas" :key="kela.id" :value="kela.id">{{ kela.kelas }}</option>
      </select>
      <p v-if="formerror.kelas_id" class="text-red-500 text-sm">{{ formerror.kelas_id[0] }}</p>
      </div>
      <button type="submit" class="py-2 px-7 rounded-xl bg-green-400">Edit</button>
      </form>
  </div>
</transition>
<!-- end edit siswa -->

<section class="py-1 bg-blueGray-50 w-max font-mules">
<div class="w-[90vw] md:w-max xl:w-8/12 mb-12 xl:mb-0 md:px-4 mt-24">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-[90vw] md:w-max mb-6 shadow-lg rounded ">
    <div class="block w-full overflow-x-auto">
      <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
          <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                NIK
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                NAMA
            </th>
           <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Aksi
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="siswa in datasiswa" :key="siswa.id">
            <td class="border-t-1 border px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700" v-text="siswa.nik"></td>
            <td class="border-t-1 border px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700" v-text="siswa.nama"></td>
            <td class="border-t-1 border px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                <button class="bg-yellow-200 p-2 rounded-md mr-4" @click="bukaeditform(siswa.id)">
                    <svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
					</svg>
                </button>
                <button class="bg-red-500 p-2 rounded-md" @click="hapusSiswa(siswa.id)">
                    <svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
						</svg>
                </button>
            </td>
          </tr>
        </tbody>

      </table>
    </div>
  </div>
</div>
</section>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            datasiswa : [],
            kelas: '',
            alerthapus: '',
            alertedit: '',
            bukaedit: false,
            form: [],
            formerror: [],
            listkelas: []
        }
    },
    methods: {
        async getSiswaByKelas(){
            await axios.get(`http://perpustakaan.test/api/siswa/${this.$route.params.id}`, {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.datasiswa = response.data.data
                    this.kelas = response.data.kelas.kelas
                })
        },
        async getkelas(){
            await axios.get('http://perpustakaan.test/api/kelas',{headers: {'Authorization': 'Bearer '+this.$store.state.token}})
            .then(response => {
                this.listkelas = response.data.data
            })
        },
        async hapusSiswa(id){
            await axios.delete(`http://perpustakaan.test/api/siswa/${id}`, {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.alerthapus = true
                    this.getSiswaByKelas()
                    setTimeout(() => {
                        this.alerthapus = false
                    }, 3000);
                })
        },
        async bukaeditform(id){
            await axios.get(`http://perpustakaan.test/api/siswa/${id}/edit` , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.bukaedit = true,
                    this.form = response.data.data
                })
        },
        async editsiswa(){
            try {
                await axios.put(`http://perpustakaan.test/api/siswa/${this.form.id}`, this.form ,{headers: {'Authorization': 'Bearer '+this.$store.state.token}} )
                    .then(response => {
                        this.alertedit = true
                        this.bukaedit = false
                        this.getSiswaByKelas()
                        setTimeout(() => {
                            this.alertedit = false
                        }, 3000);
                    })
            } catch (error) {
                this.formerror = error.response.data.errors
            }
        }
    },
    mounted() {
        this.getSiswaByKelas()
        this.getkelas()
    },
}
</script>
