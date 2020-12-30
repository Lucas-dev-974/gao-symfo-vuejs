import Axios from 'axios';
import Ordinateurs from './ordinateur.vue';
import ModalAddOrdi from './addOrdi.vue';
import { reduceRight, unset } from 'lodash';

export default{
    components:{
        Ordinateurs, 
        ModalAddOrdi
    },
    data() {
        return {
            ordinateurs: [],
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            pagination: [],
        }
    },

    mounted() { this.init(); },

    methods: {
        init(){
            this.ordinateurs = []  // important pour réactualiser le tableau a chaque changement de date

            Axios.get('/api/computers', {params: {data: this.date}})
            .then(({data}) => {
                console.log('-----');
                data = JSON.parse(data)
                console.log(data);
                data.forEach(element => {
                    this.ordinateurs.push(element)
                });
            })
        },

        updateViewOrdi(nomOrdi){
            return this.ordinateurs.push(nomOrdi)
        },
 
        delOrdi(id_ordi){
            Axios.post('/api/computers/delete?computerId=' + id_ordi).then(({data}) => {
                unset(this.ordinateurs, id_ordi)
                this.init()
                console.log('ok delete');
            }).catch(error => {
                console.log(error);
            })
        },

        removeAttr(){
            
        }
    }
}