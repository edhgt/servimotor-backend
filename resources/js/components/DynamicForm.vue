<template>
  <form @submit.prevent="onSubmit">
    <div class="row" v-if="schema.fields">
      <FormFields :fields="schema.fields" />
    </div>
    <template v-if="schema.sections" v-for="(section, idx) in schema.sections" :key="idx">
      <legend>{{ section.title }}</legend>
      <div class="row">
        <FormFields :fields="section.fields" />
      </div>
    </template>
    <button class="btn btn-primary">{{schema.submitText}}</button>
  </form>
</template>

<script ts>
import { defineComponent, watch, toRef, onBeforeMount } from 'vue';
import { configure, defineRule, useForm } from 'vee-validate';
import { localize, setLocale } from '@vee-validate/i18n';
import es from '@vee-validate/i18n/dist/locale/es.json';
import { all } from '@vee-validate/rules';
import FormFields from './FormFields.vue';

export default defineComponent({
  name: 'DynamicForm',
  components: {
    FormFields,
  },
  emits: ['submit'],
  props: {
    schema: {
      type: Object,
      required: true,
    },
    initialValues: {
      type: Object,
      default: () => ({}),
    },
    errors: {
      type: Object,
      default: () => ([]),
    },
    isResetForm: {
      type: Boolean,
      default: () => false
    }
  },
  setup(props, ctx) {
    const isResetForm = toRef(props, 'isResetForm');
    const { values: form, setValues, setFieldError, resetForm, handleSubmit} = useForm({
      initialValues: props.initialValues,
    });
    const onSubmit = handleSubmit(() => {
      ctx.emit('submit', form);
      if(isResetForm.value) {
        resetForm();
      }
    }, (errors) => {
      const firstError = Object.keys(errors.errors)[0];
      const firstInput = document.querySelector(`input[name="${firstError}"]`);
      if(firstInput) {
        firstInput.focus();
      }
    });

    watch(
      () => props.errors,
      (newErrors) => {
        Object.entries(newErrors).forEach(([key, value]) => {
          setFieldError(key, value);
        });},
      { deep: true, immediate: true }
    );

    watch(
      () => props.initialValues,
      (newValues) => {
        setValues(newValues);
      },
      { deep: true, immediate: true }
    );

    function extractAllFields(schema) {
      const schemaFields = schema.fields || [];
      const sectionFields = (schema.sections || []).flatMap((section) => section.fields || []);
      return [...schemaFields, ...sectionFields];
    }

    function extractUsedRuleNames(fields) {
      const ruleNames = new Set();

      for (const field of fields) {
        const rules = field.rules;

        if (typeof rules === 'string') {
          rules.split('|').forEach(rule => {
            const name = rule.split(':')[0].trim();
            ruleNames.add(name);
          });
        } else if (typeof rules === 'object' && rules !== null) {
          Object.keys(rules).forEach(name => {
            ruleNames.add(name);
          });
        }
      }

      return ruleNames;
    }


    onBeforeMount(() => {
      configure({
          generateMessage: localize({ es }),
      });
      setLocale('es');
      const usedRules = extractUsedRuleNames((extractAllFields(props.schema)));

      for (const ruleName of usedRules) {
        if (ruleName in all) {
          defineRule(ruleName, all[ruleName]);
        } else {
          console.warn(`Regla "${ruleName}" no existe en @vee-validate/rules`)
        }
      }
    });

    return {
      onSubmit
    };
  },
});
</script>
