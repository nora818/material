from pyecharts import options as opts
from pyecharts.charts import Bar

# 创建一个简单的柱状图
bar = Bar()
bar.add_xaxis(["A", "B", "C", "D", "E"])
bar.add_yaxis("Series", [1, 2, 3, 4, 5])

# 渲染图表并生成 HTML 代码
bar.render()

# html_code = bar.render_embed()
# 将 HTML 代码写入文件
# with open("chart.html", "w", encoding="utf-8") as f:
#     f.write(html_code)

# a = bar.render_notebook()
# print(a)