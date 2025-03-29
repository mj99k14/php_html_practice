const readline = require('readline');

const r1 = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

r1.question("첫 번째 숫자를 입력하세요: ", (answer1) => {
    r1.question("두 번째 숫자를 입력하세요: ", (answer2) => {
        const x = Number(answer1);
        const y = Number(answer2);

        const plus = (x, y) => x + y;
        const divide = (x, y) => x / y;
        const multiply = (x, y) => x * y;
        const subtract = (x, y) => x - y;

        console.log("덧셈 결과:", plus(x, y));
        console.log("뺄셈 결과:", subtract(x, y));
        console.log("곱셈 결과:", multiply(x, y));
        console.log("나눗셈 결과:", divide(x, y));

        r1.close();
    });
});
