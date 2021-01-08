@section('script-data')
                isEmpty: false,
                isComponentModalActive: false,
                campaignlist:'',
                formProps: {
                    title: '',
                    slug: '',
                    ending_date:'',
                    target_amount:'',
                    story:'',
                    apiurl:'',
                },
@endsection

@section('script-created-content')
    this.apiUrl = <?php echo "'".$apiUrl."'"; ?>;
    this.formProps.apiurl = <?php echo "'".$apiUrl."'"; ?>;
    this.csrf = <?php echo "'".csrf_token()."'"; ?>;
    this.campaignlist = @json($campaignlist);
@endsection

@section('script-method')
    submit(data){
        //console.log('Hi'+data);
        url = 'newcampaign';
        //url = this.apiUrl+url;
                    
        const headers = { headers: {
            'Content-Type': 'application/json'
        }};

        let formData = new FormData();
        formData.append('id', data.id);
        formData.append('title', data.title);
        formData.append('slug',data.slug);
        formData.append('ending_date',data.ending_date);
        formData.append('target_amount',data.target_amount);
        formData.append('feature_image',data.feature_image);
        formData.append('story',data.story);
                    
        axios.post( url,
        formData,headers
        ).then(response => {
            console.log(response);
            //this.campaign.feature_image = response.data;
            console.log('SUCCESS!!');
            this.$buefy.toast.open({
                    message: 'Campaign Successfully Created!',
                    type: 'is-success'
                })
            
            this.isComponentModalActive=false;
            location.reload(); 
        })
        .catch(function(){
            //code 422 is Vaildation error.
            this.$buefy.toast.open({
                    message: 'Something happened Worngly!',
                    type: 'is-danger'
                })
            console.log('FAILURE!!');
        });
    },
    editcampaign(data){
        this.formProps = this.campaignlist[data];
        this.isComponentModalActive = true;

    }
@endsection