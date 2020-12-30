import Axios from 'axios';

export default{
    props: {
        ModalAddOrdi: {
            default: function(){
                return {};
            }
        }
    },
    data(){
        return{
            dialog: false,
            ordiNameInput: '',
        }
    },
    methods: {
        addOrdi: function(){
            name = this.ordiNameInput
            console.log(name);
            Axios.post('/api/computers/add?computerName=' + name)
            .then(({ data }) => {
                console.log('------');
                console.log(data)
                this.dialog = false
                this.ordiNameInput = ''
                this.$emit('addview', data.data)
            });
        }
    }
}