<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <a class="navbar-brand" href="#">Navbar</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link me-3" :to="{name: 'home'}">Home</router-link>
                        </li>
                        
                        <li class="nav-item">
                            <router-link class="nav-link me-3" :to="{name: 'about'}">About</router-link>
                        </li>
                        
                        <li class="nav-item">
                            <router-link class="nav-link me-3" :to="{name: 'blog'}">Blog</router-link>
                        </li>
                    </ul>

                    <form class="d-flex">

                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style scoped lang="scss">

</style>