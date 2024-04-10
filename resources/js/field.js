import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nested-multiselect', IndexField)
  app.component('detail-nested-multiselect', DetailField)
  app.component('form-nested-multiselect', FormField)
})
