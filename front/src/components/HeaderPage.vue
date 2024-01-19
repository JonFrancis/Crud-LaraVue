<template>
    <header>
        <nav>
            <RouterLink to="/">
                Home
            </RouterLink>
            <RouterLink to="/Add">
                Add New User
            </RouterLink>
        </nav>
    </header>
</template>

<script>
import { RouterLink } from "vue-router"

export default {
    name: 'HeaderPage',
    components: { RouterLink }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300;1,900&display=swap');
header {
    background-color: #0471dd;
    padding: 1.32rem;
}

nav {
    display: flex;
    font-family: 'Merriweather', serif;
    font-weight: 400;
    font-style: normal;
    justify-content: space-between;
}

nav a {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    transition: 0.35s;
}

nav a:hover {
    color: #000000;
    text-decoration: none;
    font-size: 1.2rem;
}

</style>

