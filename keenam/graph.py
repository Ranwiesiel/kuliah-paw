
lokasi = {
    'Jakarta' : {'Bandung', 'Semarang', 'Bekasi', 'Depok', 'Tangerang', 'Bogor'},
    'Bandung' : {'Jakarta', 'Semarang', 'Yogyakarta', 'Surabaya'},
    'Semarang' : {'Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya'},
    'Yogyakarta' : {'Bandung', 'Semarang', 'Surabaya', 'Solo'},
    'Surabaya' : {'Bandung', 'Semarang', 'Yogyakarta', 'Solo'},
    'Serang' : {'Tangerang'},
    'Tangerang' : {'Serang', 'Jakarta', 'Bekasi'},
    'Bekasi' : {'Tangerang', 'Jakarta', 'Depok'},
    'Depok' : {'Bekasi', 'Jakarta', 'Bogor'},
    'Bogor' : {'Jakarta', 'Depok'},
    'Solo' : {'Yogyakarta', 'Surabaya'},
	'Malang' : {'Semarang', 'Solo', 'Yogyakarta'},
	'Jember' : {'Surabaya', 'Solo','Semarang', 'Jakarta'}
}

import networkx as nx
import matplotlib.pyplot as plt

G=nx.Graph() #deklarasi graph pertama

for i in lokasi: #untuk mengambil key dari dict, untuk membuat graph pertama
    for j in lokasi[i]: #untuk mengambil value didalam key
        G.add_edge(i, j) #menambah vertex, edge, dan bobot


# G.add_weighted_edges_from(G)
pos = nx.spring_layout(G) #membuat bentuk pola graph
nx.draw(G, pos, with_labels=True, font_weight='bold', node_color='lightgreen') #menampilkan graph
plt.title(f'Bentuk Graph') #menampilkan judul
plt.show() #menampilkan visualisasi graph menggunakan matplotlib