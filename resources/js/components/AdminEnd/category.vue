<template>
    <div>
      
 <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Category</h4>
                    <form class="form-sample" @submit.prevent="create">
                      <p class="card-description"> Products Categories </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control tex-white" v-model="form.name" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                              <button type="submit" class="btn btn-outline-success">Save </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                     
                      
                     
                    </form>

                  </div>
                </div>
              </div>   
               <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <div class="row">
                    <div class="col-md-6">
                     <input type="text" v-model="searchTerm" placeholder="Search Category" />
                    </div>
                   <div class="col-md-6">
                   <select class="bg-dark" style="float: right">
                   <option>5</option>
                     <option>50</option>
                       <option>100</option>
                   </select>
                     
                    </div>
                    </div>
                   
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>Category Name</th>
                            <th> Status </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(category,idx) in filtersearch" :key="idx">
                            <td class="py-1"> {{idx+1 }} </td>
                            <td> {{category.name}} </td>
                            
                            <td><label v-if="category.status==1" class="badge badge-success">Active</label><label v-else class="badge badge-info">InActive</label>  </td>
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
                      </div> </td>
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
    return {
        form:{
            name:null,  
        },
        categories:[],
        errors:{},
        i:0,
        searchTerm:"",
        info:null
    }
  },
  computed:{
    
filtersearch()
     {
   
return this.categories.filter(category =>{
  return category.name.toLowerCase().match(this.searchTerm.toLowerCase())
})
     },
     incrementvalue()
     {
return this.i=this.i+1;
     }
  },
methods:{
   
      create()
      {
        
        axios.post('/api/save',this.form)
        .then(resp=>{
        Toast.fire({
                 icon: 'success',
                 title: 'Successfully Saved'
                   });
                    this.getdata();
      //  Notification.success();
        /// this.$router.push({name: 'All-Category'})
         
        })
        .catch(error=>{
        //  this.errors = error.response.errors;
         Toast.fire({
                 icon: 'error',
                 title: 'Error Please Try Again'
                   });
        })
      },
       getdata()
      {
          axios.get("/api/category").then(response=>
    {
      
      this.categories = response.data;
   
    }).
    catch(error=>{
        console.log(error);
    });
      }

  }
}
</script>
