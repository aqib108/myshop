<template>
    <div>
      
   <router-link to="/Product"  class="mb-3 mx-3 btn btn-outline-primary">Add Product</router-link>
               <div class="col-lg-12 grid-margin stretch-card">
                    
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <div class="row">
                    <div class="col-md-6">
                     <input type="text" v-model="searchTerm" placeholder="Search Category" />
                    </div>
                   <div class="col-md-6">
                   <select  @change="getcategories($event)" class="bg-dark" style="float: right">
                   <option value="3">3</option>
                     <option value="5">5</option>
                       <option value="7">7</option>
                   </select>
                     
                    </div>
                    </div>
                   
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>title</th>
                            <th>Category Name</th>
                            <th> price </th>
                            <th>Images</th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(product,idx) in filtersearch" :key="idx">
                            <td class="py-1"> {{idx+1 }} </td>
                            <td> {{product.title}} </td>
                            <td> {{product.category}} </td>
                            <td> {{product.price}} </td>                
                            <td><img v-for="image in product.images" :key="image.id" :src="image.file" style="height: 90px; width: 80px" /></td>
                            <td><div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <h6 class="dropdown-header">Settings</h6>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                            </div>
                          </td>
                          </tr>
                          
                         
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>
              </div>    
    </div>
</template>

<script>
  
  export default {
   created()
    {
        this.getdata();

    },
data(){
    return{
        products:[],
        errors:{},
        searchTerm:"",
        info:null
          }
      },
  computed:{
    
filtersearch()
     {
    
        return this.products.filter(product =>{
        return product.title.toLowerCase().match(this.searchTerm.toLowerCase())
        })
     }
  },
methods:{
       getdata()
      {
          axios.get("/api/product").then(response=>
          {
               
          this.products = response.data;
   
          }).
          catch(error=>{
          console.log(error);
          });
      },
       getcategories(e)

      {
          let limit = e.target.value;
          this.products = this.products.slice(0,limit);
      }

  }
}
</script>
