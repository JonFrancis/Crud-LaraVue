<template>
  <HeaderPage></HeaderPage>
  <h2 class="my-2"> Editing user = {{users.Username}}</h2>
  <form class="container">
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" disabled class="form-control" name="username" required placeholder="Enter username"
        v-model="users.Username">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Password</label>
      <input type="password" disabled class="form-control" name="password" required placeholder="Enter Password"
        v-model="users.Password">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">First Name</label>
      <input type="text" class="form-control" name="first_name" required placeholder="Enter your first name"
        v-model="users.First_Name">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="text" class="form-control" name="last_name" required placeholder="Enter your last name"
        v-model="users.Last_Name">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Age</label>
      <input type="number" class="form-control" name="age" required placeholder="Enter your age" v-model="users.Age">
    </div>
    <div class="form-group my-3">
      <label for="exampleInputEmail1">Cellphone</label>
      <input type="number" class="form-control" name="cellphone" required placeholder="Enter your cellphone"
        v-model="users.Cellphone">
    </div>
    <button type="button" @click="editUser" class="btn btn-outline-success"> Edit User </button>
    <button type="button" @click="cancelButton" class="btn btn-outline-warning mx-2"> Cancel Edit </button>
  </form>
</template>

<script>
import HeaderPage from './HeaderPage.vue';
import axios from 'axios'

export default {
  name: 'EditPage',
  components: {
    HeaderPage
  },
  data() {
    return {
      users: {
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
    async editUser() {
      let confirmation = confirm("Are you sure you want to edit this user?")
      if(confirmation) {
        try {
          const result = await axios.put(`http://127.0.0.1:8000/api/allusers/${this.$route.params.id}/edit`, {
            Username: this.users.Username,
            Password: this.users.Password,
            First_Name: this.users.First_Name,
            Last_Name: this.users.Last_Name,
            Age: this.users.Age,
            Cellphone: this.users.Cellphone,
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
      }
    },
    async cancelButton() {
      let confirmation = confirm("Are you sure you want to cancel the edit of this user?")
      if (confirmation) {
        this.$router.push({ name: "HomePage" })
      }
    },
  },
  async mounted() {
    const result = await axios.get(`http://127.0.0.1:8000/api/allusers/${this.$route.params.id}`)
    this.users = result.data.user
    console.log(this.users.Username)
  },
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

