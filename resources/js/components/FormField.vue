<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <treeselect 
        :id="field.attribute"
        type="multiselect"
        v-model="selectedValues"
        :cotentType="'json'"
        :multiple="true"
        :options="options"
        :value-consists-of="'ALL_WITH_INDETERMINATE'"
      />
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import { Treeselect } from 'vue3-treeselect'
import 'vue3-treeselect/dist/vue3-treeselect.css'

export default {
  components: { Treeselect },
    data() {
      return {
        // define options
        options: this.options,
      }
    },

  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      console.log(this.field);
      this.value = this.field.value || ''
      this.options = JSON.parse(this.field.options[0].label);
      this.selectedValues = JSON.parse(this.value);
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
     fill( formData )
    {
      formData.append( this.field.attribute, JSON.stringify( this.selectedValues ) )
    },
  },
}
</script>
