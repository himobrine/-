from secret import flag

def get_points(a, b, p):
    # 计算所有可能的点坐标
    points = []
    for x in range(p):
        y_square = (x ** 3 + a * x + b) % p
        for y in range(p):
            if (y ** 2) % p == y_square:
                points.append((x, y))
    return points
def cal_k(point_A, point_B, p):
    if point_A == point_B:
        son = 3 * pow(point_A[0], 2) + a
        mother = 2 * point_A[1]
        return (son * pow(mother, p - 2)) % p
    else:
        son = point_B[1] - point_A[1]
        mother = point_B[0] - point_A[0]
        return (son * pow(mother, p - 2)) % p
def cal_add(point_A, point_B, p, k):
    # A+B=C,计算c的坐标
    cx = (k ** 2 - point_A[0] - point_B[0]) % p
    cy = (k * (point_A[0] - cx) - point_A[1]) % p
    return cx, cy
def cal_NA(key, point_A, point_B, p):
    # 执行0~key-1共key次
    for i in range(key - 1):
        k = cal_k(point_A, point_B, p)
        point_B = cal_add(point_A, point_B, p, k)
    return point_B
def encryption(r, Q, m, p):
    cx = cal_NA(r, A, B, p)
    rQ = cal_NA(r, Q, Q, p)
    k = cal_k(m, rQ, p)
    cy = cal_add(m, rQ, p, k)
    return cx, cy
a = 10
b = 30
p = 11
key = 23720461
points = get_points(a, b, p)
A = (2, 7)
B = (2, 7)
Q = cal_NA(key, A, B, p)
r = 3
message = flag

c = encryption(r, Q, message, p)
print(c)


# c = ((5, 8), (6, 5))