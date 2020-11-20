const { default: Axios } = require('axios');

require('./bootstrap');

const refreshRate = 5000;

Vue.component('status-summary', {
    template: `
        <div class="summary-container">
            <div class="summary-message"><slot>{{ summary }}</slot></div>
        </div>
    `,
    data: function() {
        return {
            summary: "All systems operational",
        }
    },
    methods: {
        refreshStatus() {
            window.setInterval( () => {
                Axios.get('/api/status').then(response => this.summary = response.data.status);
            }, refreshRate);
        }
    },
    mounted() {
        Axios.get('/api/status').then(response => this.summary = response.data.status);

        this.refreshStatus();
    }
});

Vue.component('service', {
    template: `
        <div v-bind:style="{'border-left': border}" class="service">
            <p class="service-name">{{ name }}</p>
            <p v-bind:style="{color: color}" class="status">{{ status }}</p>
        </div>
    `,
    data: function() {
        return {
            name: "Email",
            status: "Operational",
            color: '#5bc159'
        }
    },
    computed: {
        border: function() {
            return '52px solid ' + this.color;
        }
    },
    mounted() {
        Axios.get('/');
    }
})

new Vue({
    el: '.container',
    methods: {
        refreshPage() {
            // master controller for page refreshes
        }
    }
});
