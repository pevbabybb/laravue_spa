<template>
    <main>
        <Header/>
        <div id="layoutSidenav">
           <Sidebar/>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
 
                        </div>
                    <div class="card mb-3">
                       <div class="card-header">
                           tao la tai
                       </div>
                    </div>
                    
                </main>
              <Footer/>
            </div>
        </div>
    </main>
</template>

<script>
import Header from'./components/Header.vue';
import Sidebar from'./components/Sidebar.vue';
import Footer from'./components/Footer.vue';


export default {
    components:{
        Header,
        Sidebar,
        Footer,
    }
    
}
</script>
