import './bootstrap'

import { createApp } from 'vue'

import '../css/app.css'
import DomainList from './components/DomainList.vue'


const app = createApp(DomainList)

app.mount("#app")
