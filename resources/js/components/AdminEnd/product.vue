<template>
    <div>
      
 <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <form class="form-sample"  @submit.prevent="create">
                      <p class="card-description"> Product Information </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Title</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" v-model="form.title" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                              <select class="form-control" v-model="form.category_id">
                        <option v-for="category in categories" :value="category.id" :key="category.id">{{category.name}}</option>
                                
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="number" v-model="form.price" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Size</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="number" v-model="form.size" />
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="mx-2 form-label">description</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" rows="5" v-model="form.description"></textarea>
                            </div>
                          </div>
                        </div>
                       
                      </div>
                       <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="file" name="images[]" multiple  class="form-control" @change="onChange" accept="image/*" />
                          </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                       
                      </div>
                      <button type="submit" class="btn btn-success">Submit</button>
                      
                     
                    </form>
                  </div>
                </div>
              </div>       
    </div>
</template>

<script>
    export default {
        created()
        {
             this.getcategories();
        } ,
        data()
        {
            return{
                form:{
                   title:null,
                   category_id:null,
                   price:null,
                   size:null,
                   description:null,
                   images:[]
                },
                categories:{}
            }
        },
        methods:{
             create()
      {
        
        axios.post('/api/product-save',this.form)
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
          this.errors = error.response.data.errors;
         Toast.fire({
                 icon: 'error',
                 title: 'Error Please Try Again'
                   });
        })
      },
            onChange(e)
            {
                 const images = e.target.files;
                 //console.log(images.length);
                for(let i=0; i<images.length; i++)
                {
 const reader = new FileReader();
                reader.readAsDataURL(images[i]);
                reader.onload = e =>{
                    this.form.images.push(e.target.result);
                    
                };
                ///console.log(this.form.images);

                }
               
            },

             getcategories()
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
