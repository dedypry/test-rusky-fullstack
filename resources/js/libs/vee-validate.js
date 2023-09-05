import { defineRule } from "vee-validate";
import { required, email, integer } from "@vee-validate/rules";

defineRule('required', required);
defineRule('email',email);
defineRule('int',integer);
