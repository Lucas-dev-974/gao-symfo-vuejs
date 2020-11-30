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
            console.log('ok');
            this.ordinateurs = []  // important pour réactualiser le tableau a chaque changement de date
            Axios.get('/computers/a')
            .then(({data}) => {
                let json = JSON.parse(data);
                json.forEach(element => {
                    console.log(element);
                    this.ordinateurs.push(element);
                })
            })
        },

        updateViewOrdi(nomOrdi){
            return this.ordinateurs.push(nomOrdi)
        },

        delOrdi(id_ordi){
            Axios.post('/api/ordinateurs/delOrdi?id=' + id_ordi).then(({data}) => {
                unset(this.ordinateurs, id_ordi)
                this.init()
            }).catch(error => {
                console.log(error);
            })
        },
    }
}