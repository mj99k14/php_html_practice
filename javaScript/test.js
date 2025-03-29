const readline = require('readline');

const q = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

q.question = ("첫번쨰 입력을 하세요", (one) => {
    q.question("두번쨰 입력을 하세요", (two) => {
        const a = Number(one);
        const b = Number(two);

        const p = (a, b) => a + b;
        const m = (a, b) => a - b;
        const s = (a, b) => a * b;
        const n = (a, b) => a / b;


        setTimeout(() => {
            console.log(p(a, b))
            console.log(m(a, b))
            console.log(s(a, b))
            console.log(n(a, b))

            q.close();
        }, 3000);
    });

});




