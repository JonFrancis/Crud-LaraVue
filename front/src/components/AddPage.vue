<template>
  <HeaderPage></HeaderPage>
  <h2 class="my-2"> Add a new user </h2>
  <form class="container">
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" class="form-control" name="username" required placeholder="Enter username" v-model="users.username">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Password</label>
      <input type="password" class="form-control" name="password" required  placeholder="Enter Password" v-model="users.password">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">First Name</label>
      <input type="text" class="form-control" name="first_name" required placeholder="Enter your first name" v-model="users.firstName">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="text" class="form-control" name="last_name" required placeholder="Enter your last name" v-model="users.lastName">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Age</label>
      <input type="number" class="form-control" name="age" placeholder="Enter your age" v-model="users.age">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Cellphone</label>
      <input type="number" class="form-control" name="cellphone" required placeholder="Enter your cellphone" v-model="users.cellphone">
    </div>
    <button type="button" @click="addUser" class="btn btn-outline-success"> Add User </button>
  </form>
</template>
  
<script>
import HeaderPage from './HeaderPage.vue';
import axios from 'axios'

export default {
  name: 'AddPage',
  components: {
    HeaderPage
  },
  data() {
    return {
      users: {
        username: "",
        password: "",
        firstName: "",
        lastName: "",
        age: 0,
        cellphone: "",
      },
      error: "",
    }
  },
  methods: {
    displayErrors() {
      let errorMessage = "Validation error:\n";

      for (const field in this.validationErrors) {
        if (Object.prototype.hasOwnProperty.call(this.validationErrors, field)) {
          errorMessage += `${field}: ${this.validationErrors[field][0]}\n`;
        }
      }

    alert(errorMessage);
  },
    async addUser() {
      try {
        const result = await axios.post("http://127.0.0.1:8000/api/allusers", {
          Username: this.users.username,
          Password: this.users.password,
          First_Name: this.users.firstName,
          Last_Name: this.users.lastName,
          Age: this.users.age,
          Cellphone: this.users.cellphone,
        })
        if (result.status == 200) {
          alert(result.data.message)
          this.$router.push({ name: "HomePage" })
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.validationErrors = error.response.data.errors;
          this.displayErrors();
        } else {
          console.error(error);
        }
      }
    },
    
  }
}
</script>
  
<style>
  @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300;1,900&display=swap');
  label{
    font-family: 'Merriweather', serif;
    font-weight: 900;
    font-style: italic;
  }
</style>
  
  