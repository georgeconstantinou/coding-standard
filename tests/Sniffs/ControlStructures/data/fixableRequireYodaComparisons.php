<?php // lint >= 8.0

$foo === 123;
$foo === true;
$foo === false;
$foo === null;
$foo === [];
$foo === array();
BAR === 123;
Foo::BAR === 123;
Foo::BAR === 123.0;
$e === \Foo\Bar::BAR;
foo() === Foo::BAR;
foo() + 2 === Foo::BAR;
$foo === Foo::BAR;
$foo + 2 === Foo::BAR;
$this->foo() === Foo::BAR;
$foo === -1;
$foo === +1;
(foo() === BAR || (
	Foo::BAR === ['test']
)) ? Foo::BAR === 123.0
	: $foo === null;
(foo() === BAR || (
	Foo::BAR === array('test')
)) ? Foo::BAR === 123.0
	: $foo === null;

if (
	[Foo::BAR, Foo::BAZ] === $foo($bar) && (
		true === $bar ||
		null === $bar
	)
) {
}
if (
	array(Foo::BAR, Foo::BAZ) === $foo($bar) && (
		true === $bar ||
		null === $bar
	)
) {
}

$x = $a ?? $b === 123;

switch ($c) {
	case $d === 123:
		break;
}

$x === $$a;
(int) $bar === FOO;

$x = [self::ADMIN_EMAIL === $username ? self::ROLE_ADMIN : self::ROLE_CUSTOMER];
$x = [$username === self::ADMIN_EMAIL ? self::ROLE_ADMIN : self::ROLE_CUSTOMER];
$x = array(self::ADMIN_EMAIL === $username ? self::ROLE_ADMIN : self::ROLE_CUSTOMER);
$x = array($username === self::ADMIN_EMAIL ? self::ROLE_ADMIN : self::ROLE_CUSTOMER);

$x = array($username === array() ? true : false);
$x = array($username === [] ? true : false);
$x = [$username === array() ? true : false];
$x = [$username === [] ? true : false];

$x = $username === [$a, $b, $c];

$param === A::TYPE_A and $param === A::TYPE_B;
A::TYPE_A === $param or $param === A::TYPE_B;
$param === A::TYPE_A xor A::TYPE_B === $param;

if ($row->{self::NAME} === null) {
	return 0;
}

function ($condition, $actual) {
	return match ($condition) {
		'anything' => $actual === 1,
		default => false,
	};
};
