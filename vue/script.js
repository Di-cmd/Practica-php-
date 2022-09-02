new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        numero: 0,
        nombre: '',
        response: '',
    },
    methods: {
        sumar() {
            this.numero++
        },

        restar() {
            this.numero--
        },

        async enviar() {
            // axios.get('http://127.0.0.1:8081/cliente/crear?nombre=' + this.nombre, {
            //     headers: { 'crossDomain': true },
            // }).then(res => {
            //     console.log(res)
            // })
            let req = await axios.get('http://127.0.0.1:8081/cliente/crear', {
                params: { nombre: this.nombre }
            })
            this.response = req.data.saludo
        },
    },
    computed: {
        nombreComputed() {
            let aux = this.nombre.toUpperCase()
            return aux
        }
    },
})