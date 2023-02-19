<template>
<div class="font-mules">
  <div class="pt-10">
      <p class="font-semibold text-3xl mb-5">Jenis Buku</p>
      <button class="py-3 px-4 rounded-lg bg-[#363740] text-white" @click="bukatambah = true">Tambah Jenis Buku</button>
  </div>

<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alert" @click="alert = false">
        <p>Jenis Buku berhasi ditambahkan</p>
    </div>
</transition>
<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alerthapus" @click="alerthapus = false">
        <p>Jenis Buku berhasi dihapus</p>
    </div>
</transition>
<transition name="alert">
    <div class="fixed right-10 top-10 bg-green-500 text-white py-3 px-4 rounded-xl" v-if="alertedit" @click="alertedit = false">
        <p>Jenis Buku berhasi di perbarui</p>
    </div>
</transition>

<transition name="tutupform">
    <div v-if="bukatambah" class="fixed top-0 left-0 w-screen h-screen bg-[#0004] z-10" @click="bukatambah = false"></div>
</transition>
<transition name="formtambah">
  <div v-if="bukatambah" class="fixed p-4 rounded-xl h-max bg-white top-0 bottom-0 left-0 right-0 m-auto w-[80vw] md:w-max z-20">
      <p class="font-medium text-lg mb-5">Tambah Jenis Buku</p>
      <form @submit.prevent="tambahjenisbuku">
      <div class="mb-5">
      <label for="judul" class="font-light flex flex-col">Jenis</label>
      <input type="text" v-model="form.name" id="judul" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-full md:w-[300px]">
      <p v-if="formerror.name" class="text-red-500 text-sm">{{ formerror.name[0] }}</p>
      </div>
      <button type="submit" class="py-2 px-7 rounded-xl bg-green-400">Tambah</button>
      </form>
  </div>
</transition>

<transition name="tutupform">
    <div v-if="bukaedit" class="fixed top-0 left-0 w-screen h-screen bg-[#0004] z-10" @click="bukaedit = false"></div>
</transition>
<transition name="formtambah">
  <div v-if="bukaedit" class="fixed p-4 rounded-xl h-max bg-white top-0 bottom-0 left-0 right-0 m-auto w-max z-20">
      <p class="font-medium text-lg mb-5">Edit Jenis Buku</p>
      <form @submit.prevent="formeditjenisbuku">
      <div class="mb-5">
      <label for="judul" class="font-light flex flex-col">Jenis</label>
      <input type="text" v-model="dataeditjenisbuku.name" id="judul" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border mt-3 w-[300px]">
      <p v-if="formerror.name" class="text-red-500 text-sm">{{ formerror.name[0] }}</p>
      </div>
      <button type="submit" class="py-2 px-7 rounded-xl bg-green-400">Edit</button>
      </form>
  </div>
</transition>

<!-- table -->
<section class="py-1 bg-blueGray-50 w-max">
<div class="w-[90vw] md:w-max xl:w-8/12 mb-12 xl:mb-0 md:px-4 mt-24">
  <div class="relative flex flex-col min-w-0 break-words bg-white w-max mb-6 shadow-lg rounded ">
    <div class="block w-full overflow-x-auto">
      <table class="items-center bg-transparent w-full border-collapse ">
        <thead>
          <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Jenis Buku
            </th>
           <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                Aksi
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="jenisbuku in datajenisbuku" :key="jenisbuku.id">
            <td class="border-t-1 border px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700" v-text="jenisbuku.name"></td>
            <td class="border-t-1 border px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                <button class="bg-yellow-200 p-2 rounded-md mr-4" @click="editjenisbuku(jenisbuku.id)">
                    <svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
					</svg>
                </button>
                <button class="bg-red-500 p-2 rounded-md" @click="hapusjenisbuku(jenisbuku.id)">
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
<!-- end table -->

</div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            datajenisbuku: [],
            bukatambah : false,
            form: {
                name: ''
            },
            formerror: [],
            types: [],
            alert: false,
            alerthapus: false,
            dataeditjenisbuku: [],
            bukaedit: false,
            alertedit: false
        }
    },
    methods: {
        async tambahjenisbuku() {
            try {
                await axios.post('http://localhost:8000/api/booktypes', this.form , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    if (response.status == 200) {
                        this.alert = true
                        this.form = {
                            name: ''
                        }
                        this.bukatambah = false
                        this.tampiljenis()
                        setTimeout(() => {
                            this.alert = false
                        }, 3000);
                    }
                })
            } catch (error) {
                this.formerror = error.response.data.errors
            }
        },
        async tampiljenis(){
                    await axios.get('http://localhost:8000/api/booktypes', {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response => {
                        this.datajenisbuku = response.data.data
                    })
        },
        async hapusjenisbuku(booktype) {
                await axios.delete(`http://localhost:8000/api/booktypes/${booktype}`, {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response => {
                        this.alerthapus = true
                        this.tampiljenis()
                        setTimeout(() => {
                            this.alerthapus = false
                        }, 3000);
                })
        },
        async editjenisbuku(id){
            await axios.get(`http://localhost:8000/api/booktypes/${id}`, {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.formerror = []
                    this.bukaedit = true
                    this.dataeditjenisbuku = response.data.data
                })
        },
        async formeditjenisbuku(){
            try {
                await axios.put(`http://localhost:8000/api/booktypes/${this.dataeditjenisbuku.id}`, this.dataeditjenisbuku , {headers: {'Authorization': 'Bearer '+this.$store.state.token}})
                .then(response => {
                    this.alertedit = true
                    this.tampiljenis()
                    this.bukaedit = false
                    setTimeout(() => {
                        this.alertedit = false
                    }, 3000);
                })
            } catch (error) {
                this.formerror = error.response.data.errors
            }
        }
    },
    async mounted() {
        if (!this.$store.state.loggedIn) {
            return this.$router.push('/login')
        }
        this.$store.state.munculmenu = false
        this.tampiljenis()
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

