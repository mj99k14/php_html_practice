/*function user(first, last) {
  this.firstName = first
  this.lastName = last

}
user.prototype.getFulName = function () {
  return `${this.firstName} ${this.lastName}`
}
const heropy = new user('Heropy', 'Park')
const amy = new user('Amy', 'Clarke')
const neo = new user('Neo', 'Smith')

console.log(heropy.getFulName())
console.log(amy.getFulName())
console.log(neo.getFulName())

*/
//ES6
class User {
  constructor(first, last) {
    this.firstName = first
    this.lastName = last
  }
  getFulName() {
    return `${this.firstName} ${this.lastName}`
  }
}

const heropy = new User('Heropy', 'Park')
const amy = new User('Amy', 'Clarke')
const neo = new User('Neo', 'Smith')

console.log(heropy.getFulName())
console.log(amy.getFulName())
console.log(neo.getFulName())
