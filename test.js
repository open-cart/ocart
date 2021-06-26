const a = [4, 5, 7];

function generateKey(p, first = []) {
    let res = [];
    let key = first;

    while (p.length) {
        for (let i = 0; i < p.length; i++) {
            const item = [ ...key, ...[p[i]] ];

            const keyString = item.join(',');

            res.push(keyString);
        }
        key = [p.shift()];

        const b = [...p];

        res = res.concat(generateKey(b, [...first, ...key]));
    }
    return res;
}

const res = new Set(generateKey([...a], []));

const groups = [
    {
        id: 1,
    },
    {
        id: 2,
    },
    {
        id: 3,

    }
];

let productRelated = [
    {
        id: 1,
        attributes: [{
            id: 1,
            group: 1,
            active: true
        }, {
            id: 4,
            group: 2,
            active: true
        }, {
            id: 7,
            group: 3,
            active: true
        }]
    },
    {
        id: 2,
        attributes: [{
            id: 1,
            group: 1,
            active: true
        }, {
            id: 4,
            group: 2,
            active: true
        }, {
            id: 9,
            group: 3,
            active: true
        }]
    },
    {
        id: 3,
        attributes: [{
            id: 2,
            group: 1,
            active: true
        }, {
            id: 5,
            group: 2,
            active: true
        }, {
            id: 9,
            group: 3,
            active: true
        }]
    },
    {
        id: 4,
        attributes: [{
            id: 1,
            group: 1,
            active: true
        }, {
            id: 5,
            group: 2,
            active: true
        }, {
            id: 9,
            group: 3,
            active: true
        }]
    }
];

const g2 = {};
for (const p of productRelated) {
    for (const q of p.attributes) {
        if (!g2[q.group]) {
            g2[q.group] = [];
        }
        if (g2[q.group].findIndex(x => x.id == q.id) == -1) {
            g2[q.group].push(q);
        }
    }
}

for (const g of groups) {
    g.attrs = g2[g.id];
}
// console.log('groups', groups.map(x=>x.attrs))
productRelated = productRelated.map(x => {
    x.key = Array.from(new Set(generateKey([...x.attributes.map(x => x.id)], [])))
    return x;
})

const active = [
    {
        id: 1,
        group: 1
    },
    {
        id: 4,
        group: 2
    }
];

if (active.length === 1) {
    const at = active.find(() => true);
    for (let item of groups) {
        if (item.id === at.group) {
            continue;
        }
        for (const att of item.attrs) {
            att.active = false;
        }
    }
} else {
    for (let item of groups) {
        for (const att of item.attrs) {
            att.active = false;
        }
    }
}

const keyactive = active.map(x => x.id).join(',');

for (let item of productRelated) {
    if (item.key.indexOf(keyactive) !== -1) {
        for (let a of item.attributes) {
            console.log('g2', g2)
           const at = g2[a.group].find(x => x.id == a.id)
            at.active = true;
        }
    }
}
// console.log('productRelated', productRelated)

// console.log(productRelated.find(x => x.key.indexOf(keyactive) !== -1 ));

// console.log(groups.map(x => x.attrs));
