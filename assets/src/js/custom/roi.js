// ROI calc mount 

import { createApp } from 'vue'
import Roi from './Roi.vue'

const app = createApp(Roi)

if(document.getElementById("app")){
  app.mount('#app')
}
