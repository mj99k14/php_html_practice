const readline = require('readline');

const q = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

q.question("어떤 연산을 하시겠습니까? (+, -, *, /): ", (operator) => {
    q.question("첫 번째 숫자: ", (n) => {
        q.question("두 번째 숫자: ", (n1) => {
            const one = Number(n);
            const two = Number(n1);

            switch (operator) {
                case '+':
                    console.log(`결과: ${one + two}`);
                    break;
                case '-':
                    console.log(`결과: ${one - two}`);
                    break;
                case '*':
                    console.log(`결과: ${one * two}`);
                    break;
                case '/':
                    if (two === 0) {
                        console.log("0으로 나눌 수 없습니다!");
                    } else {
                        console.log(`결과: ${one / two}`);
                    }
                    break;
                default:
                    console.log("잘못된 연산자입니다.");
                    break;
            }

            q.close();
        });
    });
});
