<template>
  <input
    @input="$emit('input', $event.target.value)"
    :value="value"
    :type="type"
    :name="name"
    :required="required"
    class="rounded-lg p-2 border-t mr-0 text-sm border-b border-l border-r text-gray-800 border-gray-200 bg-white"
    :placeholder="placeholder"
  />
</template>

<script>
export default {
  name: "input-field",
  props: {
    name: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    placeholder: {
      type: String,
      default: "",
    },
    value: {
      default: "",
    },
    type: {
      type: String,
      default: "text",
    },
  },
};
</script>

<style></style>
