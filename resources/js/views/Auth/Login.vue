<template>
  <div class="h-screen flex justify-center items-center">

      <div class="shadow-xl rounded-lg border font-mules px-8 py-8 w-[90vw] md:w-max">
          <img src="/asset/perpus-logo.png" class="w-max mx-auto mb-3" alt="">
          <p class="font-bold text-xl mb-7 text-center text-[#A4A6B3]">Perpus STM</p>
          <p class="font-bold text-2xl text-center mb-3">Log In to Perpus Dashboard</p>
          <p class="font-normal text-[#9FA2B4] text-center mb-7">Masukkan email & password</p>
          <form @submit.prevent="login">
          <div class="flex flex-col mb-6">
              <label for="email" class="font-bold text-sm text-[#9FA2B4] mb-2">EMAIL</label>
              <input type="email" id="email" v-model="formlogin.email" placeholder="Email address" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border w-full">
          </div>
          <div class="flex flex-col mb-9">
              <label for="password" class="font-bold text-sm text-[#9FA2B4] mb-2">PASSWORD</label>
              <input type="password" v-model="formlogin.password" id="password" placeholder="Password" class="bg-[#F0F1F7] py-2 px-3 rounded-lg border w-full">
          </div>
          <button type="submit" class="bg-[#3751FF] w-full text-white py-3 rounded-lg">Log In</button>
          </form>
      </div>

  </div>
</template>

<script>
export default {
    data() {
        return {
            formlogin: {
                email: '',
                password: ''
            },
            loggedIn: localStorage.getItem('loggedIn')
        }
    },
    methods: {
        login(){
            this.$store.commit('login', this.formlogin )
        }
    },
    mounted() {
        if (this.$store.state.loggedIn) {
            return this.$router.push('/dashboard')
        }
    },
}
</script>
