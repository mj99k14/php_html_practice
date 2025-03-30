// Es6practice.js

/*let name = "김민정";
let age = 22;

console.log(`안녕하세요 ${name}님의 나이는 ${age}입니다`);

sayHello = (name) => `안녕 ${name}!`;
console.log(sayHello("민정")); 



// 구조 분해 할당을 이용해서 nickname과 age를 꺼내 변수로 저장해보세요
const user = {
    id: 101,
    nickname: "minjung22",
    age: 22,
    gender: "female"
};


const { nickname, age } = user;

console.log(nickname);
console.log(age);


const fruits = ["사과", "바나나", "포도"];
const { fruit1, fruit3} = fruits;
console.log(fruit1);
console.log(fruit3); 
let nickname = user.nickname;
let age = user.age;

console.log(nickname);
console.log(age);
*/



class Person {
    constructor(name, age) {
        this.name = name;
        this.age = age;

    }
    introduce() {
        console.log(`저는 ${this.name}나이는 ${this.age}`)
    }
}


const peopleData = [
    ["민정", 22],
    ["지훈", 25],
    ["수아", 20]
];



for (let i = 0; i < peopleData.length; i++) {
    const Person = new Person(name, age);
    Person.introduce();
}

/