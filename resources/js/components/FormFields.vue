<template>
    <div :class="`col-md-${col} mb-3`" v-for="{ as, name, label, children, col=12, ...attrs } in fields"
        :key="name">
        <label class="form-label" :for="name" v-if="as != 'checkbox'">{{ label }} <span class="text-muted" v-if="attrs.rules == undefined || attrs.rules == null">(opcional)</span></label>
        <Field :id="name" :name="name" :label="label.toLowerCase()" v-bind="attrs" v-slot="{ field }" v-if="as == 'select'">
            <Select
                v-bind="field"
                v-model="field.value"
                :url="attrs.optionsUrl"
                :multiple="attrs.multiple"
                :label="attrs.labelField"
                v-if="attrs.optionsUrl"
            />
            <v-select
                v-bind="field"
                v-model="field.value"
                :options="attrs.options"
                :reduce="item => item.code"
                :multiple="attrs.multiple"
                :label="attrs.labelField"
                v-else
            />
        </Field>
        <div class="form-check mb-3" v-else-if="as == 'checkbox'">
            <Field v-slot="{ field }" :id="name" :name="name" :label="label.toLowerCase()" v-bind="attrs" :value="true" :unchecked-value="false">
                <input type="checkbox" :id="name" class="form-check-input" :name="name" v-bind="field" :value="true" />
                <label class="form-check-label" for="is_director">
                    <label class="form-label" :for="name">{{ label }} <span class="text-muted" v-if="attrs.rules == undefined || attrs.rules == null ">(opcional)</span></label>
                </label>
            </Field>
        </div>
        <Field class="form-control" :as="as" :id="name" :name="name" :label="label.toLowerCase()" v-bind="attrs" v-else>
            <template v-if="children && children.length">
                <component v-for="({ tag, text, ...childAttrs }, idx) in children" :key="idx" :is="tag"
                    v-bind="childAttrs">
                    {{ text }}..
                </component>
            </template>
        </Field>
        <ErrorMessage v-slot="{ message }" :name="name">
            <div class="text-danger">{{ message }}</div>
        </ErrorMessage>
    </div>
</template>

<script setup>
defineProps({
  fields: {
    type: Array,
    required: true
  }
})
import { Field, ErrorMessage } from 'vee-validate';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Select from './Select.vue';
</script>