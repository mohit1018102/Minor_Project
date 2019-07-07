import pandas as pd
import io
import numpy as np
import matplotlib.pyplot as plt
#-----------------------------------------------
from sklearn.preprocessing import OneHotEncoder
from sklearn.model_selection import train_test_split # splitting dataset

#-----------------------tensorflow--------
import tensorflow as tf

data = pd.read_csv('train.csv')
data.head(420)

labels_flat=data.iloc[:,0].values
images=data.iloc[:,1:].values
one_hot_encoder=OneHotEncoder(sparse=False) 
encoded=labels_flat.reshape(len(labels_flat),1)#creates an array of 42000individual x 1
labels=one_hot_encoder.fit_transform(encoded) # categorial data into encode vector
labels=labels.astype(np.uint8) 

xtrain,xval,ytrain,yval=train_test_split(images, labels, test_size=0.2, random_state=0)

X=tf.placeholder(tf.float32,[None,784],name='Input') # placeholders<dattype,shape,name>
Y=tf.placeholder(tf.float32,[None,10],name='Output') # None because don't know the no of images


weights_1=tf.Variable(tf.truncated_normal([784, 120],stddev=0.001),name='weights_1')
biases_1=tf.Variable(tf.zeros([120]),name='biases_1')
hidden1=tf.nn.relu(tf.matmul(X,weights_1)+biases_1)

weights_2=tf.Variable(tf.truncated_normal([120, 32],stddev=0.001),name='weights_2')
biases_2=tf.Variable(tf.zeros([32]),name='biases_2')
hidden2=tf.nn.relu(tf.matmul(hidden1,weights_2)+biases_2)

weights_3=tf.Variable(tf.zeros([32, 10]),name='weights_3')
biases_3=tf.Variable(tf.zeros([10]),name='biases_3')
Ylogits=tf.matmul(hidden2,weights_3)+biases_3
output=tf.nn.softmax(Ylogits) # for output : softmax activation function

#cross_entropy difference bw actual and predicted value
cross_entropy=tf.reduce_mean(tf.nn.softmax_cross_entropy_with_logits_v2(logits=Ylogits,labels=Y))
optimizer=tf.train.GradientDescentOptimizer(0.005) #gradient descent optimizer learning rate alpha=0.005
train_step=optimizer.minimize(cross_entropy) # GD optimizer help us to minimize loss

# correct pred is used to find which predictions are correct and which predictions are wrong
correct_prediction=tf.equal(tf.argmax(output,1),tf.argmax(Y,1))
#argmax() it pick up the index of maximum value in array
#output is an array of probability and it picks the index of highest prob
# equal fuction compares the value of both the arrays

accuracy=tf.reduce_mean(tf.cast(correct_prediction,tf.float32))
# calculates accuracy
# cast convert it to float datatype
# reduce_min to get the mean or avg value

with tf.Session() as sess:
  init=tf.global_variables_initializer()
  sess.run(init)
  
  batch_size=200 # no of images pass to the neural network {none-->batch_size}
  epoch=100 # how many times training data pass through the neural network
  iterations=int(xtrain.shape[0]/batch_size) 
  
  for ep in range(epoch):
    for i in range(iterations):
      batch_start=(i*batch_size)%(xtrain.shape[0]-batch_size)
      batch_end=batch_start + batch_size
      batch_X=xtrain[batch_start:batch_end]
      batch_Y=ytrain[batch_start:batch_end]
      train_data={X:batch_X,Y:batch_Y}
      
      sess.run(train_step, feed_dict=train_data)
    ans=sess.run(accuracy,feed_dict={X:xval,Y:yval})
    print("EPOCH NUMBER "+str(ep+1)+" |","Accurracy : {} %".format(ans*100))
