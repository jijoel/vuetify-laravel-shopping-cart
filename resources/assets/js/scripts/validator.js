import dot from 'dot-object';

export default class Validator {

    fields = {};
    errors = {};

    constructor(fields)
    {
        this.fields = this._clone(fields)
    }

    update(fields) {
        const changed = this._checkChanges(fields, this.fields)
        const value = dot.pick(changed, fields)

        dot.copy(changed, changed, fields, this.fields)
        this._setError(changed, '')
    }

    getErrors(field) {
        if (this.hasError(field))
            return this.errors[field];

        return '';
    }

    hasError(field) {
        return typeof this.errors[field] !== 'undefined'
            && this.errors[field] !== ''
    }

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
        for (var key in check) {
            if ( typeof check[key] === 'object')
                return this._checkChanges(check[key], original[key], key+".")

            if (check[key] !== original[key])
                return part+key
        }
    }

    _setError(field, value)
    {
        this.errors[field] = value;
    }

}


