
const ModalForm = {
        props: ['title', 'slug','ending_date','target_amount','story','apiurl','id','feature_image'],
        data: function(){
            return {
                selected: new Date(),
                showWeekNumber: false,
                locale: undefined,
                file:[],
                campaign:{'id':'','title':'','slug':'','ending_date': new Date(),'target_amount':'','story':'','feature_image':'','images':''}
            }
        },
        mounted(){
            this.campaign.title = this.title;
            this.campaign.slug = this.slug;
            this.campaign.target_amount = this.target_amount;
            this.campaign.story = this.story;
            this.campaign.feature_image = this.feature_image;
            this.campaign.id = this.id;

            this.file['name'] = this.feature_image;
        },
        watch: {
                file: function (val) {
                    this.imageUpload();
                }
        },
        methods:{
            imageUpload(){
                    //$image = file.name;
                    url = '/imageupload';
                    url = this.apiurl+url;
                    console.log(this.file);
                    const headers = { headers: {
                        'Content-Type': 'multipart/form-data'
                    }};
                    let formData = new FormData();
                    formData.append('file', this.file);
                    axios.post( url,
                        formData,headers
                        ).then(response => {
                            console.log(response);
                            this.campaign.feature_image = response.data.path;
                            console.log('SUCCESS!!');
                        })
                        .catch(function(){
                            console.log('FAILURE!!');
                    });
                },
                submit(){
                    console.log('inside component'+this.campaign);
                    this.$emit('formdata',this.campaign);
                }
        },
        template: `
            <div class="modal-card" >
                <header class="modal-card-head">
                    <p class="modal-card-title">New Campaign</p>
                </header>
                <section class="modal-card-body">
                    <b-field label="Title">
                        <b-input
                            type="text"
                            v-model="campaign.title"
                            :value="title"
                            placeholder="Your Campaign Title"
                            required>
                        </b-input>
                    </b-field>
                    <b-field label="Slug URL">
                        <b-input
                            type="text"
                            v-model="campaign.slug"
                            :value="slug"
                            placeholder="Slug URL"
                            required>
                        </b-input>
                    </b-field>

                    <b-field label="Ending Date">
                        <b-datepicker
                            v-model="campaign.ending_date"
                            :show-week-number="showWeekNumber"
                            :locale="locale"
                            placeholder="Click to select..."
                            icon="calendar-today"
                            trap-focus>
                        </b-datepicker>
                    </b-field>

                    <b-field label="Target Amount">
                        <b-input
                            type="text"
                            v-model="campaign.target_amount"
                            :value="target_amount"
                            placeholder="How Much Amount You Want To Collect"
                            required>
                        </b-input>
                    </b-field>
                    <b-field label="Feature Image">
                        <b-upload v-model="file" expanded>
                            <a class="button is-primary is-fullwidth">
                            <b-icon icon="upload"></b-icon>
                            <span>@{{ file.name || "Click to upload"}}</span>
                             </a>
                        </b-upload>
                    </b-field>
                    <b-field label="Story">
                        <b-input
                            type="textarea"
                            v-model="campaign.story"
                            :value="story"
                            placeholder="Write Story About Your Campaign"
                            required>
                        </b-input>
                    </b-field>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="$parent.close()">Close</button>
                    <button @click="submit" class="button is-primary">Submit</button>
                </footer>
            </div>
        `
    }
