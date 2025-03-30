const heropy = {
  firstName: 'Heropy',
  lastName: 'Park',
  getFulName: function () {
    return `${this.firstName} ${this.lastName}`
  }
}

console.log(heropy.getFulName())