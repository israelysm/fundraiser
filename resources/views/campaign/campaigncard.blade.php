
Vue.component('campaign-card', {
  props: ['id','title','ending_date','story','feature_image','amount','target_amount','index'],
  data: function () {
    return {
      
    }
  },
  template: `<div class="column is-4 p-1">
        <div class="card p-0">
            <div class="card-image">
                <figure class="image is-2by1">
                    <img :src="feature_image" alt="Placeholder image">
                </figure>
            </div>
            <div class="card-content" style="padding: 3px;">
                
                <b-progress :value="75" size="is-small" type="is-success" style="height: 5px; margin-bottom: 0.5rem;"></b-progress>
                <div class="is-flex is-justify-content-space-between">
                    <div class="is-size-6">@{{amount}}INR</div>
                    <div class="is-size-6">@{{target_amount}}INR</div>
                </div>
                <div class="media m-1">
                    <div class="media-content">
                        <p class="title is-6">@{{title}}</p>
                        <p class="subtitle is-6">Ending Date: @{{ending_date | formatDate }}</p>
                    </div>
                </div>

                <div class="content m-1 is-size-7" style="padding: 3px;">
                    @{{story}}
                </div>
                <footer class="card-footer">
                    <a href="#" class="card-footer-item is-size-7 cardbtnpadding">Share</a>
                    <a @click="$emit('editcampaign',index)" class="card-footer-item is-size-7 cardbtnpadding">Edit</a>
                    <a :href="\'campaign/\'+id+\'/delete\'" class="card-footer-item is-size-7 cardbtnpadding">Delete</a>
                </footer>
            </div>
        </div>
    </div>`
})
