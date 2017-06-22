import RuleValidator from 'validatorjs'
import dot from 'dot-object';

export default class Validator {

    current_field = '';
    fields = {};
    errors = {};
    rules = {};
    el = {};

    constructor(vueObject)
    {
        this.el = vueObject.el
        this.fields = this._clone(vueObject.fields)
        this.rules = vueObject.rules

        window.addEventListener
            ? window.addEventListener('blur', () => this._checkErrors(), true)
            : window.attachEvent('onblur', () => this._checkErrors());
    }

    /**
     * Run updates when the field is changed
     * - store the current value of the field
     * - clear errors
     */
    update(fields) {
        const changed = this._checkChanges(fields, this.fields)
        const value = dot.pick(changed, fields)

        dot.copy(changed, changed, fields, this.fields)
        this._setError(changed, '')
        this.current_field = changed
    }

    /**
     * Return all errors for a given field
     */
    getErrors(field) {
        if (this.hasError(field))
            return this.errors[field];

        return '';
    }

    /**
     * Determine if specified field has an error
     */
    hasError(field) {
        return typeof this.errors[field] !== 'undefined'
            && this.errors[field] !== ''
    }

    /**
     * Set errors from an object (eg, Laravel errors)
     */
    setErrors(errors) {
        this.errors = errors
    }

    _clone(fields) {
      var cloned = {}
      for (var key in fields) {
        if (typeof fields[key] === 'object') {
            cloned[key] = this._clone(fields[key])
        } else {
            cloned[key] = fields[key]
        }
      }
      return cloned
    }

    _checkChanges(check, original, part="")
    {
        if (this.current_field
        && check[this.current_field] != original[this.current_field])
            return this.current_field;

        for (var key in check) {
            if ( typeof check[key] === 'object')
                return this._checkChanges(check[key], original[key], key+".")

            if (check[key] !== original[key])
                return part+key
        }
    }

    _checkErrors()
    {
        if (! this.current_field || ! this.rules[this.current_field])
            return;

        const current = this.current_field;

        var rules = {}
        rules[current] = this.rules[current];

        var field = {}
        field[current] = dot.pick(current, this.fields);

        const validation = new RuleValidator(
            field, rules
        );

        if (validation.fails()) {
            this.errors[current] = validation.errors.get(current)
            this.el.$forceUpdate()
        }
    }

    _setError(field, value)
    {
        this.errors[field] = value;
    }

}


