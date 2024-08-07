import itertools

# 1から37までの数字の範囲
numbers = range(1, 38)

# 7つのメインの数字と2つの追加の数字の組み合わせを生成
combinations = list(itertools.combinations(numbers, 9))

# 587番目の組み合わせを取得（リストは0から始まるため、586を指定）
result = combinations[586]
print(result)
